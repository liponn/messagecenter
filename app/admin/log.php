<?php
defined("__FRAMEWORKNAME__") or die("No permission to access!");
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/18
 * Time: 16:04
 */
/**
 * 日志列表
 * @pageroute
 */
function lst()
{
    $framework = getFrameworkInstance();
    $logModel = new \Model\Log();
    $page = I('get.p/d', 1);
    $type = I('get.type/d',1);
    $data = $logModel->getList($page,$type);
    $userNum = $data['num'];
    $results = $data['info'];
    $page_num = $data['page_num'];
    $framework->smarty->assign('total', $userNum);
    $framework->smarty->assign('lists', $results);
    $framework->smarty->assign("pagination_link",$page_num );
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
    $url = urldecode(trim($logInfo->url));
    $curl = new \Lib\Curl\Curl();
    if (false !== stripos($url, 'https')) {
        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
        $curl->setOpt(CURLOPT_SSL_VERIFYHOST, false);
    }
    $curl->setOpt(CURLOPT_TIMEOUT, 3);
    $curl->post($url, json_decode($logInfo->send_data,true));
    if (!$curl->errorCode || $curl->errorCode == 28) {
        $logSaveModel = new \Model\Log($logInfo->id);
        $logSaveModel->err_code = $curl->httpStatusCode;
        $logSaveModel->status = \Model\Subscribe::STATUS_SUCCESS;
        if($logSaveModel->save())
            ajaxReturn(array('error'=>'200','msg'=>'发送成功'));
    }
    ajaxReturn(array('error'=>'100','msg'=>'发送失败'));

}