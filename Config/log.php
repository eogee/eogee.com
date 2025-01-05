<?php

/**
 * Log configuration
 * 日志保存配置
 */
return [
    // 保存路径
    'log_path' => 'Storage/Log',

    // 是否开启访问日志记录
    'router_cache_enabled' => true,

    // 文件名
    'log_file' => 'app.log',

    // 是否在控制台显示
    'log_to_console' => false,
];