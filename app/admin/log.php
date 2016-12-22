<?php defined("__FRAMEWORKNAME__") or die("No permission to access!");

/**
 * 日志列表
 * @pageroute
 */
function lst()
{
    $framework = getFrameworkInstance();

    $page = I('get.p/d', 1);
    $type = I('get.type/d',1);
    $tag = I("get.tag/s",'');

    $logModel = new \Model\Log();
    $tagModel = new \Model\Tags();

    $where = [];
    if(in_array($type,[0,1]))
        $where['status'] = $type;
    $tagRow = $tagModel->where(['title' => $tag])->get()->row();
    if($tagRow)
        $where['tag_id'] = $tagRow->id;


    $total = $logModel->where($where)->countNums();
    $pagination = new \Lib\Pagination([
        'total' => $total,
        'pagesize' => C('PAGE_SIZE'),
        'current_page' => $page
    ]);
    $pageLink = $pagination->createLink();

    $data = $logModel->where($where)->orderby(["id" => "DESC"])->limit($pagination->start,$pagination->offset)->get()->resultArr();
    $tagList = $tagModel->get()->resultArr();
    $tagMap = array_combine(array_column($tagList,'id'),$tagList);
    
    $btn = ["default","primary","success","info","warning","danger"];

    $framework->smarty->assign('total', $total);
    $framework->smarty->assign('lists', $data);
    $framework->smarty->assign('btn', $btn);
    $framework->smarty->assign('tagMap', $tagMap);
    $framework->smarty->assign('tagList', $tagList);
    $framework->smarty->assign("pagination_link", $pageLink);
    $framework->smarty->display('log/list.html');
}

/**
 * @pageroute
 * 发送重试
 */
function retry()
{
    $id = I('post.id');
    $logModel = new \Model\Log();
    $logInfo = $logModel->where(array('id'=>$id))->get()->row();
    if(!$logInfo)
        ajaxReturn(array('error'=>'100','msg'=>'没有该条数据'));
    $curl = new \Lib\Curl\Curl();
    if (false !== stripos($logInfo->url, 'https')) {
        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
        $curl->setOpt(CURLOPT_SSL_VERIFYHOST, false);
    }
    $curl->setOpt(CURLOPT_TIMEOUT, 3);
    $curl->post($logInfo->url, json_decode($logInfo->send_data,true));
    if (!$curl->errorCode || $curl->errorCode == 28) {
        $logSaveModel = new \Model\Log($logInfo->id);
        $logSaveModel->err_code = $curl->httpStatusCode;
        $logSaveModel->status = \Model\Subscribe::STATUS_SUCCESS;
        if($logSaveModel->save())
            ajaxReturn(array('error'=>'200','msg'=>'发送成功'));
    }
    ajaxReturn(array('error'=>'100','msg'=>'发送失败'));

}