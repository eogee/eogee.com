<?php

function defineRoutes($routes, $controller, $actions) {
    foreach ($actions as $action) {
        $routes["/$controller/$action"] = ["{$controller}Controller", $action]; // 使用控制器类名
    }
    return $routes;
}

$routes = [];
/* 前台 首页 */
$routes['/'] = [CONFIG['default_controller'],CONFIG['default_action']];
$routes['/index'] = [CONFIG['default_controller'],CONFIG['default_action']];

/* 前台 内容页 */
$routes['/contentParent/detail'] = ['ContentParentController','detail'];
$routes['/content/detailChild'] = ['ContentController','detailChild'];
$routes['/singlePage/detail'] = ['SinglePageController','detailChild'];
$routes['/news'] = ['NewsController',CONFIG['default_action']];

/* 后台 首页 */
$routes['/admin'] = ['AdminController',CONFIG['default_action']];
$routes['/admin/index'] = ['AdminController',CONFIG['default_action']];

/* 后台 登陆-退出 */
$routes = defineRoutes($routes, 'auth', [
    'login', 'logout', 'captcha'
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

$router->define($routes);
