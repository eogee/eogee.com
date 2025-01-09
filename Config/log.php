<?php

/**
 * Log configuration
 * 日志配置
 */
return [
    // 保存路径
    'log_path' => 'Storage/Log',

    // 是否开启访问日志记录
    'log_enabled' => getenv('LOG_ENABLED'),

    // 文件名
    'log_file' => 'app.log',

    // ID锁文件名
    'log_id_lock' => 'log_id.lock',

    // 是否在控制台显示
    'log_to_console' => false,

    // 是否倒序显示
    'log_sort_desc' => true,

    // 清空日志 是否重置日志ID
    'log_id_reset' => true,
];