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
    $SubscribeModel = new \Model\Log();
    $page = I('get.p/d', 1);
    $type = I('get.type/d',1);
    $data = $SubscribeModel->getList($page,$type);
    $userNum = $data['num'];
    $results = $data['info'];
    $page_num = $data['page_num'];
    $framework->smarty->assign('total', $userNum);
    $framework->smarty->assign('lists', $results);
    $framework->smarty->assign("pagination_link",$page_num );
    $framework->smarty->display('log/list.html');
}