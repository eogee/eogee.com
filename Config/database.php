<?php

/**
 * Database configuration
 * 数据库配置
 * @author Eogee
 * @email eogee@qq.com 
 */
return [
    // 数据库链接配置
    'name'=> 'eogee',
    'host' => 'localhost', 
    'user'=> 'root',
    'password'=> 'root',
    'charset'=> 'utf8',
    'collate'=> 'utf8mb4_unicode_ci',

    // 引擎配置
    'engine' => 'InnoDB',
    
    // 用户表名配置
    'user_table' => 'user',
];