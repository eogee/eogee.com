<?php

/**
 * Database configuration
 * 数据库配置
 * @author Eogee
 * @email eogee@qq.com 
 */
return [
    // 数据库链接配置
    'name'=> 'eogee',// 数据库名
    'host' => 'localhost', // 数据库主机地址
    'port' => '3306', // 数据库端口
    'user'=> 'root',// 数据库用户名
    'password'=> 'root',// 数据库密码
    'charset'=> 'utf8',// 数据库字符集
    'collate'=> 'utf8mb4_unicode_ci',// 数据库排序规则

    // 引擎配置
    'engine' => 'InnoDB',// 数据库引擎
    
    // 用户表名配置
    'user_table' => 'user',// 用户表名
    'user_col' => 'username',// 用户表用户名字段名
];