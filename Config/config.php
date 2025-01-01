<?php

use Helper\Path;
/**
 * 配置文件
 */
return [
    
    /**
     * 站点配置
     */
    'app' => require_once Path::rootPath().'/Config/app.php',

    /**
     * 数据库配置
     */
    'database' => require_once Path::rootPath().'/Config/database.php',
    /**
     * 路由配置
     */
    'route' => require_once Path::rootPath().'/Config/route.php',

/*     //开发者模式
    'developer_mode'=>false,//开发者模式，开启后将显示错误信息
    'test_env_ip'=>'111.227.244.105',//测试环境IP地址 */
];