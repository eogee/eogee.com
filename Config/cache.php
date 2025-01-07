<?php

/**
 * Cache configuration
 * 缓存配置
 */
return [
    // 缓存路径
    'cache_path' => '/Storage/Cache',

    // 是否开启路由缓存
    'router_cache_enabled' => true,

    // 路由缓存文件名
    'router_cache_file' => 'route.cache',

    // 默认缓存时间
    'default_cache_time' => 3600,
];