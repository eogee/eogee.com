<?php

use Helper\Path;
use Easy\Route\Route;
use Easy\Session\Session;

/**
 * Summary of index
 * 入口文件
 * @author Eogee
 * @email eogee@qq.com 
 */
//require_once __DIR__.'/../App/autoload.php';//引入自动加载

require __DIR__ . '/../vendor/autoload.php';

define('CONFIG',require_once Path::rootPath().'/Config/config.php');//引入配置文件
$session = new Session;
$session->start();
$router = Route::getInstance();//实例化路由
require_once Path::rootPath().'/App/routes.php';//引入路由文件
CONFIG['app']['developer_mode'] == false ? Path::rootPath().'/App/error.php' : null ;//引入错误文件
$uri = $_SERVER['REQUEST_URI'];//获取当前请求的uri
if(strpos($uri,'?')){
    $uri = substr($uri,0,strpos($uri,'?'));
}//获取当前请求的uri，去除get参数
$router->index( $uri);//执行路由