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

/**
 * @pageroute
 */
function mcQueue(){
    $mcQueue = new \Lib\McQueue();
    $putStatus = $mcQueue->put('register',['user_id' => 777 ,'realname'=> '刘奇','mobile'=>'18811176547','ip' => '127.0.0.1','datetime' => '2016.05.18 20:19:12']);
    if(!$putStatus)
    {
        $error = $mcQueue->getErrMsg();//  ['err_code' => $mcQueue->errCode ,'err_msg' => $mcQueue->errMsg];
        dump($error);
    }

}

/**
 * @pageroute
 * 用户列表
 */
function login(){
    $framework = getFrameworkInstance();
    if ($_POST) {
        $name      = I('post.username');
        $password  = I('post.password');
        $randKey = date('d');
        if(($name == "admin") && ($password == ("mc" .$randKey)))
        {
            $_SESSION['user']['isadmin'] = true;
            redirect(U('admin.php',['c' => 'subscribe' , 'a' => 'lst']));
        }
        else
        {
            die("帐号或密码错误");
        }
    } else {
        $framework->smarty->display('index/login.html');
    }

}