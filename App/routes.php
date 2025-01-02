<?php

use Helper\Cache;

/**
 * Summary of defineRoutes
 * 定义路由
 * @param mixed $routes 路由数组
 * @param mixed $controller 控制器类名
 * @param mixed $actions 方法数组
 * @return mixed
 */
function defineRoutes($routes, $controller, $actions) {
    foreach ($actions as $action) {
        $routes["/$controller/$action"] = ["{$controller}Controller", $action]; // 使用控制器类名
    }
    return $routes;
}

$cashe = new Cache();

/* 判定是否开启路由缓存 及 路由缓存是否存在 */ 
if(CONFIG['cache']['router_cache_enabled'] and $cashe->get('routes')){
    $routes = $cashe->get('routes');
}else{
    $routes = [];
    /* 前台 首页 */
    $routes['/'] = [CONFIG['route']['default_controller'],CONFIG['route']['default_action']];
    $routes['/index'] = [CONFIG['route']['default_controller'],CONFIG['route']['default_action']];

    /* 前台 技术支持 */
    $routes['/support'] = ['SinglePageController','support'];

    /* 前台 内容页 */
    $routes['/contentParent/detail'] = ['ContentParentController','detail'];
    $routes['/content/detailChild'] = ['ContentController','detailChild'];
    $routes['/singlePage/detail'] = ['SinglePageController','detailChild'];
    $routes['/news'] = ['NewsController',CONFIG['route']['default_action']];

    /* 后台 首页 */
    $routes['/admin'] = ['AdminController',CONFIG['route']['default_action']];
    $routes['/admin/index'] = ['AdminController',CONFIG['route']['default_action']];

    /* 后台 登陆-退出 */
    $routes = defineRoutes($routes, 'auth', [
        'login', 'logout', 'setCaptcha'
    ]);

    /* 后台 访问日志 */
    $routes = defineRoutes($routes, 'log', [
        'listApi', 'tableHeadDataApi', 'deleteBatch', 'show', 'showApi', 'delete'
    ]);

    /* 后台 提交站点 */
    $routes['/site/post'] = ['SiteController', 'post'];

    /* 后台 网站基本信息 */
    $routes = defineRoutes($routes, 'basicInfo', [
        'list', 'listApi', 'tableHeadDataApi', 'edit', 'updateApi', 'fileUploadApi'
    ]);

    /* 后台 轮播图 */
    $routes = defineRoutes($routes, 'carousel', [
        'list', 'listApi', 'tableHeadDataApi', 'show', 'showApi', 'insert',  'edit', 'updateApi', 'fileUploadApi', 'deleteSoft', 'deleteSoftBatch', 'recycle', 'recycleApi', 'restore', 'restoreBatch', 'delete', 'deleteBatch'
    ]);

    /* 后台 友情链接 */
    $routes = defineRoutes($routes, 'footUrl', [
        'list', 'listApi', 'tableHeadDataApi', 'show', 'showApi', 'insert',  'edit', 'updateApi', 'deleteSoft', 'deleteSoftBatch', 'recycle', 'recycleApi', 'restore', 'restoreBatch', 'delete', 'deleteBatch'
    ]);

    /* 后台 主体内容 */
    $routes = defineRoutes($routes, 'contentParent', [
        'list', 'listApi', 'tableHeadDataApi', 'show', 'showApi', 'insert', 'edit', 'updateApi', 'fileUploadApi', 'deleteSoft', 'deleteSoftBatch', 'recycle', 'recycleApi', 'restore', 'restoreBatch', 'delete', 'deleteBatch'
    ]);

    /* 后台 主体内容明细 */
    $routes = defineRoutes($routes, 'content', [
        'list', 'listApi', 'tableHeadDataApi', 'show', 'showApi', 'insert', 'edit', 'updateApi', 'fileUploadApi', 'deleteSoft', 'deleteSoftBatch', 'recycle', 'recycleApi', 'restore', 'restoreBatch', 'delete', 'deleteBatch'
    ]);

    /* 后台 单页内容 */
    $routes = defineRoutes($routes, 'singlePage', [
        'list', 'listApi', 'tableHeadDataApi', 'show', 'showApi', 'insert',  'edit', 'updateApi', 'fileUploadApi', 'deleteSoft', 'deleteSoftBatch', 'recycle', 'recycleApi', 'restore', 'restoreBatch', 'delete', 'deleteBatch'
    ]);

    /* 后台 最新动态 */
    $routes = defineRoutes($routes, 'news', [
        'list', 'listApi', 'tableHeadDataApi', 'edit', 'updateApi', 'fileUploadApi'
    ]);

    /* 管理员管理 */
    $routes = defineRoutes($routes, 'user', [
        'list', 'listApi', 'tableHeadDataApi', 'show', 'showApi',  'checkUsernameApi', 'insert', 'edit', 'updateApi', 'fileUploadApi', 'deleteSoft', 'deleteSoftBatch', 'recycle',  'recycleApi', 'restore', 'restoreBatch', 'delete', 'deleteBatch'
    ]);

    /* 用户管理 */
    $routes = defineRoutes($routes, 'role', [
        'list', 'listApi', 'tableHeadDataApi', 'show', 'showApi',  'insert', 'edit', 'updateApi', 'fileUploadApi', 'deleteSoft', 'deleteSoftBatch', 'recycle', 'recycleApi', 'restore', 'restoreBatch', 'delete', 'deleteBatch'
    ]);

    /* 后台 权限管理 */
    $routes = defineRoutes($routes, 'permissionParent', [
        'list', 'listApi', 'tableHeadDataApi', 'show', 'showApi', 'insert', 'edit', 'updateApi', 'fileUploadApi', 'deleteSoft', 'deleteSoftBatch', 'recycle', 'recycleApi', 'restore', 'restoreBatch', 'delete', 'deleteBatch'
    ]);

    /* 后台 权限明细 */
    $routes = defineRoutes($routes, 'permission', [
        'list', 'listApi', 'tableHeadDataApi', 'show', 'showApi', 'insert', 'edit', 'updateApi', 'fileUploadApi', 'deleteSoft', 'deleteSoftBatch', 'recycle', 'recycleApi', 'restore', 'restoreBatch', 'delete', 'deleteBatch'
    ]);
    /* 如开启路由缓存 则缓存路由 */
    if(CONFIG['cache']['router_cache_enabled']){
        $cashe->set('routes', $routes, 3600);
    }
}

/* 定义路由 */
$router->define($routes);
