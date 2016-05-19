<?php
/**
 * \Event::setEventCallback用于设置系统级事件回调
 * 1.事件名称由系统给出,不可乱写,瞎写.
 * 2.每个事件回调函数的参数都是系统固定给出,无法自定义
 * 3.事件的定义可以重复!!!相同的事件多个回调,将会被按定义的顺序挨个回调
 */


/**
 * 事件名:psr-4规范加载类被实例化后
 * 自动加载类完成加载之后 可以继续加载命名空间
 * \Event::setEventCallback('_after_loadAutoLoader', function ($autoloader) {
 *       //$autoloader->addNamespace("Lib", __FRAMEWORK_LIB_PATH__);
  *  });
 */



/**
 * 事件名:路由被解析执行前
 * 常见使用场景
 * 1.可以在此拦截路由做RBAC权限
 * 2.可以在此做路由转发
 *
 * 示例; 开发统一RBAC权限管理
 * 1.是否当前访问的是后台模块
 * 2.利用路由转发给统一的权限校验程序处理
 * 3.权限校验程序逻辑编写
 * \Event::setEventCallback('_before_parseRoute', function ($module, $controller, $action) {
 *           if ($module == "admin") {
 *          Route::execRoute("index/indexComment");
 *      }
 *  });
 */
\Event::setEventCallback('_before_parseRoute', function ($module, $controller, $action) {
    //如果当前访问的是后台, 且 访问不是登录页面
    /*$framework = getFrameworkInstance();
    $framework->smarty->assign('CURRENT_USER',$_SESSION['user']['name']);*/
    if($module == 'admin' && (!Route::checkRoute('admin/index/login'))){
        if($_SESSION)
        {
            $framework = getFrameworkInstance();
            $SubscribeModel = new \Model\Subscribe();
            $page = I('get.p/d', 1);
            $data = $SubscribeModel->getList($page);
            $userNum = $data['num'];
            $results = $data['info'];
            $page_num = $data['page_num'];
            $framework->smarty->assign('total', $userNum);
            $framework->smarty->assign('lists', $results);
            $framework->smarty->assign("pagination_link",$page_num );
            $framework->smarty->assign('CURRENT_USER',$_SESSION['user']['name']);
        }
        else
        {
            Route::execRoute("admin/index/login");
        }

    }
});
