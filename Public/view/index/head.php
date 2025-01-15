<?php
$indexData = $data;
?>
<!-- 前台首页 头部文件 -->
<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title><?= $indexData['title'] ?></title>
    <meta name="keywords" content="<?= $indexData['keywords'] ?>">
    <meta name="description" content="<?= $indexData['description'] ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="baidu-site-verification" content="codeva-pTAulOUztL" /><!-- 百度验证 -->
    <meta name="baidu-site-verification" content="codeva-9ZOmyWPYEm" />
    <meta name="msvalidate.01" content="07DCCB9A7D723A9B1C0E4493FFA72770" /><!-- bing验证 -->
    <meta name="sogou_site_verification" content="BOJbo4nVyh" /><!-- 搜狗验证 -->
    <meta name="360-site-verification" content="a0cb143ca79bdcbd3239111ddc5160cc" /><!-- 360验证 -->
    <link rel="stylesheet" href="/layui/css/layui.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/eogee-text-layui.css" rel="stylesheet">
    <!-- 网站标题 图标 -->
    <link rel="icon" href="<?= $indexData['titleIconImage'] ?>" type="image/x-icon">
    <script src="/layui/layui.js"></script>
    <script src="/js/index/index.js"></script>
</head>

<body>
    <div class="layui-header eog-header eog-background-white">
        <!-- 头部导航栏 -->
        <div class="layui-container">
            <div class="eog-logo">
                <!-- logo -->
                <a class="logo" href="<?= $indexData['indexUrl'] ?>">
                    <img src="<?= $indexData['logo']['image'] ?>" alt="<?= $indexData['logo']['alt'] ?>">
                </a>
            </div>
            <div class="eog-header-nav">
                <ul class="layui-nav layui-bg-gray eog-background-white"><?php
                $nav = $indexData['nav'];
                for ($i = 0; $i < count($nav); $i++) { ?>
                    
                    <li class="layui-nav-item">
                        <a href="javascript:;"><?= $nav[$i]['titleAbbre'] ?></a>
                        <dl class="layui-nav-child <?= $i == 0 ? 'layui-nav-child-l' : null ?><?= $i == count($nav) - 1 ? 'layui-nav-child-r' : null ?>" style="margin-right: -21px;"><?php
                        
                        for ($j = 0; $j < count($nav[$i]['childData']); $j++) { ?>

                            <dd><a href="/content/detailChild/<?= $nav[$i]['childData'][$j]['id'] ?>"><?= $nav[$i]['childData'][$j]['title'] ?></a></dd><?php } ?>

                            <dd><a href="/contentParent/detail/<?= $nav[$i]['id'] ?>"><?= $nav[$i]['lastChildTitle'] ?></a></dd>
                        </dl>
                    </li><?php
                    } ?>

                    <li class="layui-nav-item">
                        <a href="javascript:;"><?=$indexData['singlePageName']?></a>
                        <dl class="layui-nav-child layui-nav-child-r"><?php
                            $singlePage = $indexData['singlePage']; 
                            foreach ($singlePage as $key => $value) { ?>

                            <dd><a href="/singlePage/detail/<?= $value['id'] ?>"><?= $value['title'] ?></a></dd><?php } ?>

                            <dd><a href="/news"><?= $indexData['newsTitle'] ?></a></dd>
                        </dl>
                    </li>
                </ul>
                <!-- 移动端向右菜单展示 -->
                <div id="navLeft" class="eog-header-more">
                    <i id="iconRight" class="layui-icon layui-icon-shrink-right"></i>
                </div>
                <div id="navRight" class="eog-header-more">
                    <i id="iconLeft" class="layui-icon layui-icon-spread-left layui-hide"></i>
                </div>
                <!-- 移动端 另起一行 单独显示的菜单或按钮-->
                <div class="eog-header-tool eog-background-white">
                    <div>
                        <form>
                            <input type="text" class="layui-input" placeholder="搜索..." name="search">
                            <div class="layui-input-split">
                                <button type="submit"></button>
                            </div>
                        </form>
                    </div>
                    <div>
                        <a href="<?= $indexData['navTool']['url'] ?>" class="layui-btn layui-btn-sm layui-btn-radius">
                            <?= $indexData['navTool']['name'] ?>
                            
                        </a>
                    </div>
                    <div>
                        <a id = "login" href="javascript:;">
                            <?= $_SESSION['username'] ?? '登录/注册' ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        // 移动端弹窗尺寸
        if (window.innerWidth < 850){
            var area = ['100%', '100%'];
        }else{
            var area = ['400px', '650px'];
        }

        // 从右侧弹窗尺寸
        if (window.innerWidth < 850){
            var areaRight = ['100%',  '100%'];
        }else{
            var areaRight = ['400px', '100%'];
        }        

        // 获取登录用户名
        fetch('/index/getUserSessionInfo')
            .then(response => response.json())
            .then(data => {
                var value = data.username;
                var login = document.getElementById('login')
                login.onclick = function() {
                    if (value) {
                        layer.open({
                            title: '个人中心',
                            type: 2,
                            offset: 'r',
                            anim: 'slideLeft', // 从右往左
                            area: areaRight,
                            shade: 0.1,
                            shadeClose: true,
                            content: '/index/personal',
                            end: function() {
                                window.location.reload();
                            }
                        });
                    }else{
                        // 打开登录弹窗
                        layui.use(function() {
                            var layer = layui.layer;
                            layer.open({
                                title: '登录/注册',
                                type: 2,
                                area: area,
                                content: '/index/login',
                                end: function() {
                                    window.location.reload();
                                }
                            });
                        });
                    }                    
                }
            })
            .catch(error => {
                console.error('获取会话数据失败:', error);
            });        
    </script>