<?php defined("__FRAMEWORKNAME__") or die("No permission to access!");

/**
 * @pageroute
 * 默认起始页
 */
function index()
{
    $method = I('m','once');
    if($method == 'once')
    {

    }
    else
    {

    }
}

function putOne(){
    $input = file_get_contents("php://input");
    $post = json_decode($input, true);
    $tag = I('data.tag/s', null, null, $post);
    $data = I('data.data/a', [], null, $post);
    if ($tag) {
        //$tagsModel = new \Model\Tags();
        //$sendCh = $tagsModel->getSendCh($tag);
        $sendCh = mt_rand(1, 3);
        if ($sendCh) {
            $redis = getReidsInstance();
            if (intval($sendCh) == \Model\Tags::SEND_CH_QUICK) {
                $redis->lpush(QUEUE_QUICK, json_encode(['tag' => $tag, 'data' => $data]));
            } elseif (intval($sendCh) == \Model\Tags::SEND_CH_NORMAL) {
                $redis->lpush(QUEUE_NORMAL, json_encode(['tag' => $tag, 'data' => $data]));
            } else {
                $redis->lpush(QUEUE_SLOW, json_encode(['tag' => $tag, 'data' => $data]));
            }
            $redis->close();
            header('HTTP/1.1 200 OK');
            die;

        }

    }
    header('HTTP/1.1 404 Not Found');
    die;
}


function putMulti(){

}
