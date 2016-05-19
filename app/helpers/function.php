<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/5/18
 * Time: 18:03
 */
/**
 * @param $status 状态值 1：成功 0:失败
 * @param $url 跳转url
 * @param $controller 控制器名
 */
function urlJump($status,$url,$controller)
{
    if($status)
    {
        redirect($url,'2',$controller.'  success');
    }else
    {
        redirect($url,'2',$controller.'  failed');
    }
}