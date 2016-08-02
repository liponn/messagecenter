<?php defined("__FRAMEWORKNAME__") or die("No permission to access!");
extension_loaded('swoole') OR die('Cannot load swoole extension!');
/**
 * @pageroute
 * 启动
 */
function run()
{
    try {
        $swoole = new \swoole_server(C('SWOOLE_IP'), C('SWOOLE_PORT'));
        $swoole->set([
            'daemonize' => C('SWOOLE_DAEMONIZE'),
            'worker_num' => C('SWOOLE_WORKER_NUM'),
            'log_file' => __APP_LOGS_PATH__ . '/swoole.log'
        ]);
        $swoole->on('WorkerStart', 'onWorkerStart');
        $swoole->on('Receive', 'onReceive');
        $swoole->start();
    } catch (\Exception $e) {
        logs(['err_code' => $e->getCode(), 'err_msg' => $e->getMessage()], 'error');
    }
}

/**
 * 连接redis
 */
function connectRedis()
{
    static $redisInstance;
    if (!$redisInstance) {
        $redisInstance = new redis();
    }
    try {
        $redisInstance->ping();
    } catch (\RedisException $e) {
        $status = false;
        $i = 0;
        while (!$status) {
            $status = $redisInstance->pconnect(C('REDIS_HOST'), C('REDIS_PORT'), C("REDIS_TIMEOUT"));
            if (C('REDIS_PWD'))
                $status = $redisInstance->auth(C('REDIS_PWD'));
            if (0 !== $i)
                logs('connect fail,retry in 5 sec', 'warning');
            ++$i;
            sleep(5);
        }
    }
    return $redisInstance;
}

function onWorkerStart(swoole_server $swoole, $worker_id)
{
    $chQuick = [0, 1, 2, 3];
    $chNormal = [4, 5];
    $chSlow = [6];

    for ($i = 1; $i <= 3000; $i++) {

        $redis = connectRedis();//断线重连redis
        $queueData = $keys = [];
        if (in_array($worker_id, $chQuick)) {
            if ($redis->llen(QUEUE_QUICK))
                $keys[] = QUEUE_QUICK;
            if ($keys)
                $queueData = $redis->brpop(QUEUE_QUICK, 5);
        } elseif (in_array($worker_id, $chNormal)) {
            if ($redis->llen(QUEUE_NORMAL))
                $keys[] = QUEUE_NORMAL;
            if ($redis->llen(QUEUE_QUICK))
                $keys[] = QUEUE_QUICK;
            if ($keys)
                $queueData = $redis->brpop(QUEUE_NORMAL, QUEUE_QUICK, 5);
        } elseif (in_array($worker_id, $chSlow)) {
            if ($redis->llen(QUEUE_SLOW))
                $keys[] = QUEUE_SLOW;
            if ($redis->llen(QUEUE_NORMAL))
                $keys[] = QUEUE_NORMAL;
            if ($redis->llen(QUEUE_QUICK))
                $keys[] = QUEUE_QUICK;
            if ($keys)
                $queueData = $redis->brpop(QUEUE_SLOW, QUEUE_QUICK, QUEUE_NORMAL, 5);
        } else {
            if ($redis->llen(QUEUE_FAIL))
                $keys[] = QUEUE_FAIL;
            if ($redis->llen(QUEUE_SLOW))
                $keys[] = QUEUE_SLOW;
            if ($redis->llen(QUEUE_NORMAL))
                $keys[] = QUEUE_NORMAL;
            if ($redis->llen(QUEUE_QUICK))
                $keys[] = QUEUE_QUICK;
            if ($keys)
                $queueData = $redis->brpop(QUEUE_FAIL, QUEUE_QUICK, QUEUE_NORMAL, QUEUE_SLOW, 5);
        }
        if ($queueData) {
            $queueName = $queueData[0];
            $message = $queueData[1];
            if ($worker_id == QUEUE_FAIL_WORKER_ID && $queueName == QUEUE_FAIL) {
                call_user_func_array('retryPostMessage', [&$message, &$redis]);
            } else {
                call_user_func_array('postMessage', [&$message, &$redis]);

            }

        }
        else
        {
            sleep(5);
        }

    }
    $redis->close();
    unset($redis);
    method_exists($swoole, 'stop') ? $swoole->stop() : @exit;

}


function postMessage(&$message, &$redis)
{

    $messageArr = json_decode($message, true);
    if (json_last_error()) {
        logs(['sourceData' => $message, 'error' => 'Parse json error.']);
    }

    $tagName = $messageArr['tag'];
    $data = $messageArr['data'];
    $data['tag'] = $tagName;

    $tagsModel = new \Model\Tags();
    $tagId = $tagsModel->getIdByName($tagName);
    $subscribeModel = new \Model\Subscribe();
    $subscribeList = $subscribeModel->getByTagId($tagId);
    if ($subscribeList) {
        foreach ($subscribeList as $subscribe) {
            $curl = new \Lib\Curl\Curl();
            if (false !== stripos($subscribe->url, 'https')) {
                $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
                $curl->setOpt(CURLOPT_SSL_VERIFYHOST, false);
            }
            $curl->setOpt(CURLOPT_TIMEOUT, 3);
            $curl->post($subscribe->url, $data);

            $logModel = new \Model\Log();
            $logModel->subscribe_id = $subscribe->id;
            $logModel->tag_id = $tagId;
            $logModel->setField('send_data', json_encode($data),false);
            $logModel->response_data = $curl->rawResponse;
            $logModel->url = $subscribe->url;
            $logModel->create_time = date('Y-m-d H:i:s');
            if (!$curl->errorCode || $curl->errorCode == 28) {
                $logModel->err_code = $curl->httpStatusCode;
                $logModel->status = \Model\Subscribe::STATUS_SUCCESS;
                $logModel->save();
            } else {
                $logModel->err_code = $curl->errorCode;
                $logModel->status = \Model\Subscribe::STATUS_FAIL;
                $logId = $logModel->save();
                $redis->lpush(QUEUE_FAIL, json_encode(['tag' => 'fail', 'data' => $logId]));
            }
            unset($logModel);
            unset($curl);
            unset($subscribe);
        }

    }

    unset($subscribeList);
    unset($tagsModel);
    unset($subscribeModel);

}


function retryPostMessage(&$message, &$redis)
{

    $messageArr = json_decode($message, true);
    $logId = $messageArr['data'];

    $logModel = new \Model\Log($logId);
    if ($logModel->retry <= 3) {
        $curl = new \Lib\Curl\Curl();
        if (false !== stripos($logModel->url, 'https')) {
            $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
            $curl->setOpt(CURLOPT_SSL_VERIFYHOST, false);
        }
        $curl->setOpt(CURLOPT_TIMEOUT, 3);
        $curl->post($logModel->url, json_decode($logModel->send_data,true));

        $logModel->response_data = $curl->rawResponse;
        $logModel->retry = ++$logModel->retry;
        $logModel->update_time = date('Y-m-d H:i:s');

        if (!$curl->errorCode || $curl->errorCode == 28) {
            $logModel->err_code = $curl->httpStatusCode;
            $logModel->status = \Model\Subscribe::STATUS_SUCCESS;
            $logModel->save();
        } else {
            $logModel->err_code = $curl->errorCode;
            $logModel->status = \Model\Subscribe::STATUS_FAIL;
            $logId = $logModel->save();
            $redis->lpush(QUEUE_FAIL, json_encode(['tag' => 'fail', 'data' => $logId]));
        }
        $logModel->save();
        unset($curl);
    }
    unset($logModel);
}

function onReceive(swoole_server $swoole, $fd, $from_id, $data)
{

}