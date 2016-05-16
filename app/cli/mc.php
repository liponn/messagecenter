<?php
try {
    $swoole = new \swoole_server(C('SWOOLE_IP'), C('SWOOLE_PORT'));
    $swoole->set([
        'daemonize' => C('SWOOLE_DAEMONIZE'),
        'worker_num' => C('SWOOLE_WORKER_NUM'),
    ]);
    $swoole->on('WorkerStart', 'onWorkerStart');
    $swoole->on('Receive', 'onReceive');
    $swoole->start();
} catch (\Exception $e) {
    echo $e->getMessage();
}


function onWorkerStart(swoole_server $swoole, $worker_id)
{
    $chQuick = [0, 1, 2, 3];
    $chNormal = [4, 5];
    $chSlow = [6];
    $redis = new redis();
    $redis->pconnect(C('REDIS_HOST'), C('REDIS_PORT'), C('REDIS_PWD'));
    for ($i = 0; $i <= 299; $i++) {
        if (in_array($worker_id, $chQuick)) {
            $message = $redis->rpop(QUEUE_QUICK, 10);
        } elseif (in_array($worker_id, $chNormal)) {
            $message = $redis->brpop(QUEUE_NORMAL, QUEUE_QUICK, 10);
        } elseif (in_array($worker_id, $chSlow)) {
            $message = $redis->brpop(QUEUE_SLOW, QUEUE_QUICK, QUEUE_NORMAL, 10);
        } else {
            $message = $redis->brpop(QUEUE_FAIL, QUEUE_QUICK, QUEUE_NORMAL, QUEUE_SLOW, 10);
        }

        if($worker_id == QUEUE_FAIL_WORKER_ID)
        {
            call_user_func_array('retryFail',[&$message,&$redis]);
        }
        else
        {
            call_user_func_array('normalQueue',[&$message,&$redis]);
        }
    }
    $redis->close();
    unset($redis);
    method_exists($swoole, 'stop') ? $swoole->stop() : @exit;

}


function normalQueue(&$message,&$redis){

    $messageArr = json_decode($message);
    if (json_last_error()) {
        logs(['sourceData' => $message, 'error' => 'Parse json error.']);
    }

    $tagName = $messageArr['tag'];
    $data = $messageArr['data'];

    $tagsModel = new \Model\Tags();
    $tagId = $tagsModel->getIdByName($tagName);

    $subscribeModel = new \Model\Subscribe();
    $subscribeList = $subscribeModel->getByTagId($tagId);

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
        $logModel->send_data = json_encode($data);
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
            $redis->lpush(QUEUE_FAIL,['tag' => 'fail','data' =>$logId]);
        }
        unset($logModel);
        unset($curl);
    }

    unset($tagsModel);
    unset($subscribeModel);

}


function retryFail(&$message,&$redis){

    $messageArr = json_decode($message);
    $logId = $messageArr['data'];

    $logModel = new \Model\Log($logId);
    if($logModel->retry <=3 )
    {
        $curl = new \Lib\Curl\Curl();
        if (false !== stripos($logModel->url, 'https')) {
            $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
            $curl->setOpt(CURLOPT_SSL_VERIFYHOST, false);
        }
        $curl->setOpt(CURLOPT_TIMEOUT, 3);
        $curl->post($logModel->url, $logModel->send_data);

        $logModel->response_data = $curl->rawResponse;
        $logModel->retry = ++$logModel->retry;
        $logModel->update = date('Y-m-d H:i:s');

        if (!$curl->errorCode || $curl->errorCode == 28) {
            $logModel->err_code = $curl->httpStatusCode;
            $logModel->status = \Model\Subscribe::STATUS_SUCCESS;
            $logModel->save();
        } else {
            $logModel->err_code = $curl->errorCode;
            $logModel->status = \Model\Subscribe::STATUS_FAIL;
            $logId = $logModel->save();
            $redis->lpush(QUEUE_FAIL,['tag' => 'fail','data' =>$logId]);
        }
        $logModel->save();
    }
    unset($messageArr);
    unset($logId);
    unset($logModel);
}

function onReceive(swoole_server $swoole, $fd, $from_id, $data)
{

}

function onFinish(swoole_server $swoole, $task_id, $data)
{

}


function onWorkerStop(swoole_server $swoole, $worker_id)
{
    echo $worker_id . 'exit' . PHP_EOL;
}