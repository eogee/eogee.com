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
    
];