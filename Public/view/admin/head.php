<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>EOGEE 管理后台</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/layui/css/layui.css">
    <?= CONFIG['app']['dark_theme'] ?"<link rel='stylesheet' href='/css/eogee-admin-dark.css'>" : null?>
    <link rel="stylesheet" href="/css/eogee-admin.css">
    <link rel="icon" href="/pic/logomini-2.ico" type="image/x-icon">
    <script src="/layui/layui.js"></script>
    <script src="/js/admin/eogee-admin-layui.js"></script>
</head>

<body>
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header">
            <a href="/admin">
                <div class="layui-logo layui-bg-black">EOGEE 管理后台</div>
            </a>
            <ul class="layui-nav layui-layout-left">
                <li id = "iconLeft" class="layui-nav-item layui-hide"><a href='javascript:;'><i class="layui-icon layui-icon-spread-left"></i></a></li>
                <li id = "iconRihgt" class="layui-nav-item layui-hide"><a href='javascript:;'><i class="layui-icon layui-icon-shrink-right"></i></a></li>
                <li id = "iconLayer" class="layui-nav-item layui-hide"><a href="/" target="_blank"><i class="layui-icon layui-icon-layer"></i></a></li>
                <li id = "textLayer" class="layui-nav-item"><a href="/" target="_blank"><i class="layui-icon layui-icon-layer"></i> 主站</a></li>
            </ul>
            <ul class="layui-nav layui-layout-right">
                <li id = "textLogout" class="layui-nav-item"><a href="/auth/logout"><i class="layui-icon layui-icon-logout"></i> 退出登录</a></li>
                <li id = "iconLogout" class="layui-nav-item layui-hide"><a href="/auth/logout"><i class="layui-icon layui-icon-logout"></i></a></li>
            </ul>
        </div>
        <div class="layui-side layui-bg-black layui-hide-xs">
            <div class="layui-side-scroll">
                <!-- 左侧导航区域 -->
                <ul class="layui-nav layui-nav-tree">
                    <li id = "indexNav" class="layui-nav-item">
                        <a class="" href="javascript:;">首页设置</a>
                        <dl class="layui-nav-child">
                            <dd id = "basicInfoChildNav"><a href="/basicInfo/list">基本信息</a></dd>
                            <dd id = "carouselChildNav"><a href="/carousel/list">轮播图设置</a></dd>
                            <dd id = "footUrlChildNav"><a href="/footUrl/list">底部链接</a></dd>
                        </dl>
                    </li>
                    <li id = "contentParentNav" class="layui-nav-item">
                        <a href="javascript:;">内容中心</a>
                        <dl class="layui-nav-child">
                            <dd id = "contentParentChildNav"><a href="/contentParent/list">主体内容</a></dd>
                            <dd id = "singlePageChildNav"><a href="/singlePage/list">单页内容</a></dd>
                            <dd id = "newsChildNav"><a href="/news/list">最新动态</a></dd>
                            <dd id = "categoryNav"><a href="/category/list">文章分类</a></dd>
                            <dd id = "articleNav"><a href="/article/list">文章管理</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;">站点功能</a>
                        <dl class="layui-nav-child">
                            <dd><a href="/site/post">提交站点</a></dd>
                        </dl>
                    </li>
                    <li id = "userParentNav" class="layui-nav-item">
                        <a href="javascript:;">用户管理</a>
                        <dl class="layui-nav-child">
                            <dd id = "userNav"><a href="/user/list">用户管理</a></dd>
                            <dd id = "roleNav"><a href="/role/list">角色管理</a></dd>
                            <dd id = "permissionParentNav"><a href="/permissionParent/list">权限管理</a></dd>
                        </dl>
                    </li>
                </ul>
            </div>
        </div>


        