<?php defined("__FRAMEWORKNAME__") or die("No permission to access!");
/**
 * @pageroute
 * 用户列表
 */
function lst(){
    $framework = getFrameworkInstance();
    $adminUserModel = new Model\AdminUser();
    $userList = $adminUserModel->listTable()->resultArr();
    $framework->smarty->assign('userList', $userList);
    $framework->smarty->display('user/list.html');
}