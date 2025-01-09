<?php

use Helper\Path;

require_once 'env.php';

env();//加载环境变量

/**
 * Main configuration
 * 配置文件 索引文件
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
     * 中间件注册
     */
    'middleware' => require_once Path::rootPath().'/Config/middleware.php',
    /**
     * 路由配置
     */
    'route' => require_once Path::rootPath().'/Config/route.php',
    /**
     * 文件配置
     */
    'file' => require_once Path::rootPath().'/Config/file.php',
    /**
     * 缓存配置
     */
    'cache' => require_once Path::rootPath().'/Config/cache.php',
    /**
     * 日志记录
     */
    'log' => require_once Path::rootPath().'/Config/log.php',   
    /**
     * 邮箱配置
     */
    'mail' => require_once Path::rootPath().'/Config/mail.php',
];