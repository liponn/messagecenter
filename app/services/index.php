<?php defined("__FRAMEWORKNAME__") or die("No permission to access!");

/**
 * @pageroute
 * 默认起始页
 */
function index(){
    lpush();
}


/**
 * @pageroute
 * 测试
 */
function test(){
    $curl =  new \Lib\Curl\Curl();
    $input = json_encode(['tag' => 'register' , 'data' => ["userId" => 11190, 'name' => 'PhperSid' , 'mobile' => '18811176547']]);
    $curl->post('http://liuqi.dev.wanglibao.com/messageCenter/app/web/services.php',$input);
    dump($curl->httpStatusCode);
}

/**
 * @pageroute
 * 写队列
 */
function lpush(){
    $input = file_get_contents("php://input");
    $post = json_decode($input,true);
    $tag = I('data.tag/s',null,null,$post);
    $data = I('data.data/a',[],null,$post);
    if($tag)
    {
        $tagsModel = new \Model\Tags();
        $sendCh = $tagsModel->getSendCh($tag);
        if($sendCh)
        {
            $redis = getReidsInstance();
            if(intval($sendCh) == \Model\Tags::SEND_CH_QUICK)
            {
                $redis->lpush(QUEUE_QUICK,json_encode(['tag' => $tag, 'data' => $data]));
            }
            elseif(intval($sendCh) == \Model\Tags::SEND_CH_NORMAL)
            {
                $redis->lpush(QUEUE_NORMAL,json_encode(['tag' => $tag, 'data' => $data]));
            }
            else
            {
                $redis->lpush(QUEUE_SLOW,json_encode(['tag' => $tag, 'data' => $data]));
            }
            $redis->close();
            header('HTTP/1.1 200 OK');
            die;

        }

    }
    header('HTTP/1.1 404 Not Found');
    die;
}