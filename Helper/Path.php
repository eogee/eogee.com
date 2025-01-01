<?php
namespace Helper;


/**
 * 处理路径相关
 * @author eogee.com email:eogee@qq.com
 */
class Path {
    /**
     * 获取项目根目录
     * @return string 返回项目根目录的绝对路径
     */
    public static function rootPath() {

        return realpath(dirname(__DIR__));

    }
}