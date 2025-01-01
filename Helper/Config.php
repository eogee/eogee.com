<?php
namespace Helper;

/**
 * 配置相关类
 * @author <eogee.com> <eogee@qq.com>
 */
class Config {
    /**
     * Summary of getConfig
     * 获取配置信息
     * @param mixed $key
     * @return mixed
     */
    public static function getConfig($key)
    {
        return CONFIG[$key];
    }
}