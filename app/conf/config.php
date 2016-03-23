<?php
return [
    "DEFAULT_CONTROLLER" => 'index', //默认控制器
    "DEFAULT_ACTION" => 'index', //默认方法

    "BASE_HOST" => 'http://liuqi.setting.dev.wanglibao.com', //域名

    "URL_CONTROL_NAME" => 'c', // 默认控制器参数名
    "URL_ACTION_NAME" => 'a', // 默认动作参数名
    "URL_MODE" => 0, // 0 GET  1 PATHINFO

    "REDIS_HOST" => "", //redis主机地址
    "REDIS_PORT" => "", //redis端口
    "REDIS_PWD" => "", //redis密码
    "REDIS_TIMEOUT" => "", //redis超时时间

    "SQS_HOST" => "", //HTTPSQS主机地址
    "SQS_PORT" => "",//HTTPSQS端口
    "SQS_PWD" => "", //HTTPSQS密码
    "SQS_CHARSET" => "", //HTTPSQS编


    "DB_TYPE" => 'pdo', //连接驱动
    //"DB_HOST" => '127.0.0.1', //主机地址
    "DB_HOST" => '192.168.1.36', //主机地址
    "DB_PORT" => 3306,//端口
    "DB_USERNAME" => 'root',//用户名
    "DB_PASSWORD" => '123123',//密码
    "DB_NAME" => 'gas',//数据库名
    "DB_PREFIX" => '',//表前缀
    "DB_PCONNECT" => false, //长连接
    "DB_DEBUG" => true, //调试模式
    "DB_CHARSET" => 'utf8', //编码

    "PAGE_SIZE" => 20, //分页每页数量


];
