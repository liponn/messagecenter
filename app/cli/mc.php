<?php
try {
    $swoole = new \swoole_server("127.0.0.1", 6767);
    $swoole->set([
        'daemonize'  => false,
        'worker_num' => 8,
    ]);
    $swoole->on('WorkerStart', 'onWorkerStart');
    $swoole->on('Receive', 'onReceive');
    $swoole->start();
} catch (\Exception $e) {
    echo $e->getMessage();
}

function post($url,$data){

    $curl = new \Lib\Curl\Curl();
    if (false !== stripos($url, 'https')) {
        $curl->setOpt(CURLOPT_SSL_VERIFYPEER,false);
        $curl->setOpt(CURLOPT_SSL_VERIFYHOST,false);
    }
    $curl->setOpt(CURLOPT_TIMEOUT,3);
    $response =  $curl->post($url,$data);
    if(!$curl->errorCode || $curl->errorCode == 28 )
    {
        //写日志
        unset($curl);
        return $response;
    }
    else
    {
        return false;
    }

}




function onWorkerStart(swoole_server $swoole, $worker_id)
{

    $redis = new redis();
    $redis->pconnect('127.0.0.1',6379);
    for($i = 0; $i <=  9; $i++)
    {
        $data = $redis->rpop('message');
        echo $data;
    }
    $redis->close();
    method_exists($swoole,'stop') ? $swoole->stop() : @exit;
}

function onReceive(swoole_server $swoole, $fd, $from_id, $data)
{

}

function onFinish(swoole_server $swoole, $task_id, $data)
{

}


function onWorkerStop(swoole_server $swoole, $worker_id)
{
    echo $worker_id . 'exit' .PHP_EOL;
}