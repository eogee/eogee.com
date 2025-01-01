<?php

use Helper\Path;
/**
 * 配置文件
 */
return [
    /**
     * 数据库配置
     */
    'database' => require_once Path::rootPath().'/Config/database.php',
    /**
     * 路由配置
     */
    'route' => require_once Path::rootPath().'/Config/route.php',
    
    /*//默认控制器和方法
    'default_controller' => 'IndexController',
    'default_action' => 'index', */

    //开发者模式
    'developer_mode'=>false,//开发者模式，开启后将显示错误信息
    'test_env_ip'=>'111.227.244.105',//测试环境IP地址
];