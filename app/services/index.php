<?php defined("__FRAMEWORKNAME__") or die("No permission to access!");

/**
 * @pageroute
 * 默认起始页
 */
function index()
{
    try {
        $input = file_get_contents("php://input");
        $post = json_decode($input, true);
        $tag = I('data.tag/s', null, null, $post);
        $dataSource = I('data.data/a', [], null, $post);
        $tagsModel = new \Model\Tags();
        $sendCh = $tagsModel->getSendCh($tag);

        if($sendCh)
        {
            if(!isset($dataSource[0]))
            {
                $dataList = [ $dataSource];
            }
            else
            {
                $dataList = $dataSource;
            }
            putQueue($sendCh, $tag, $dataList);
            header('HTTP/1.1 200 OK');
            die;
        }

    } catch (\Exception $e) {
        logs(['err_code' => $e->getCode(),'err_msg' => $e->getMessage()]);
        header('HTTP/1.1 404 Not Found');
        die;
    }

}

function putQueue($channel, $tag, $dataList)
{
    $redis = getReidsInstance();
    foreach ($dataList as $data) {
        if (intval($channel) == \Model\Tags::SEND_CH_QUICK) {
            $redis->lpush(QUEUE_QUICK, json_encode(['tag' => $tag, 'data' => $data]));
        } elseif (intval($channel) == \Model\Tags::SEND_CH_NORMAL) {
            $redis->lpush(QUEUE_NORMAL, json_encode(['tag' => $tag, 'data' => $data]));
        } else {
            $redis->lpush(QUEUE_SLOW, json_encode(['tag' => $tag, 'data' => $data]));
        }
    }
    $redis->close();

}
