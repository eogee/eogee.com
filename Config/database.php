<?php

/**
 * Database configuration
 * 数据库配置
 * @author Eogee
 * @email eogee@qq.com 
 */
return [
    // 数据库链接配置
    'name'=> getenv('DB_NAME'),// 数据库名
    'host' => getenv('DB_HOST'), // 数据库主机地址
    'user'=> getenv('DB_USER'),// 数据库用户名
    'password'=> getenv('DB_PASSWORD'),// 数据库密码    
    'port' => getenv('DB_PORT'), // 数据库端口
    'charset'=> 'utf8',// 数据库字符集

    // 引擎配置
    'engine' => 'InnoDB',// 数据库引擎
    
    // 用户表名配置
    'user_table' => 'user',// 用户表名
    'user_col' => 'username',// 用户表用户名字段名
];