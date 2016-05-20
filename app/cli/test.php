<?php defined("__FRAMEWORKNAME__") or die("No permission to access!");
/**
 * 写一条消息到队列中 (**不可用循环来代替一次性多条消息入列**)
 * @pageroute
 */
function mcQueue(){
    $mcQueue = new \Lib\McQueue();

    $data =  ['user_id' => 777 ,'realname'=> '刘奇','mobile'=>'18811176547','ip' => '127.0.0.1','datetime' => date('Y-m-d H:i:s')];
    $putStatus = $mcQueue->put('register',$data);

    if(!$putStatus)
    {
        $error = $mcQueue->getErrMsg();//  ['err_code' => $mcQueue->errCode ,'err_msg' => $mcQueue->errMsg];
        dump($error);
    }

}

/**
 * 写多条消息到队列中
 * @pageroute
 */
function mcQueueMulti(){
    $mcQueue = new \Lib\McQueue();

    $item = ['user_id' => 777 ,'realname'=> '刘奇','mobile'=>'18811176547','ip' => '127.0.0.1','datetime' => date('Y-m-d H:i:s')];
    $datas = array_fill(0, 10000, $item);
    $putStatus = $mcQueue->put('register',$datas);
    if(!$putStatus)
    {
        $error = $mcQueue->getErrMsg();//  ['err_code' => $mcQueue->errCode ,'err_msg' => $mcQueue->errMsg];
        dump($error);
    }

}