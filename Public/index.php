<?php
use Helper\Route;
/**
 * Summary of index
 * 入口文件
 * @author eogee.com
 */
define('CONFIG',require_once __DIR__.'/../Config/app.php');//引入配置文件
session_start();//开启session
require_once __DIR__.'/../App/autoload.php';//引入自动加载
$router = Route::getInstance();//实例化路由
require_once __DIR__.'/../App/routes.php';//引入路由文件
CONFIG['developer_mode'] == false ? require_once __DIR__.'/../App/error.php' : null ;//引入错误文件
$uri = $_SERVER['REQUEST_URI'];//获取当前请求的uri
if(strpos($uri,'?')){
    $uri = substr($uri,0,strpos($uri,'?'));
}//获取当前请求的uri，去除get参数
$router->index( $uri);//执行路由