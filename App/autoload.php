<?php
/**
 * 自动加载类
 */
function autoload($className) 
{
    $filePath = __DIR__.'/../'.$className.'.php';#将类名转化为文件路径
    if (file_exists($filePath)) {
        require_once $filePath;
    }
}
// 注册自动加载函数
spl_autoload_register('autoload');