<!DOCTYPE html>
<html>
<head>
    <title>更新数据</title>
    <link rel="stylesheet" href="/layui/css/layui.css">    
    <?= CONFIG['app']['dark_theme'] ?"<link rel='stylesheet' href='/css/eogee-admin-dark.css'>" : null?>
    <script src="/layui/layui.js"></script>
    <script src="/js/admin/eogee-admin-layui.js"></script>
</head>
<body>
    <div style="padding: 10px 10px 35px 10px;">
        <div class="layui-tab layui-tab-brief">
            <ul class="layui-tab-title">
                <li class = "layui-this"><h2>基础信息</h2></li>
            </ul>
        </div>
        <form class = "layui-form" method = "post" lay-filter = "form" id = "form">
        <table class = "layui-table">
            <colgroup>
                <col width="110">
            </colgroup>
            <thead>
                <tr>
                    <th>项目</th>
                    <th>内容</th>
                </tr>
            </thead>
            <tbody>
                <input id = "hiddenId" type="hidden" name="id">
                <!-- crsf令牌 -->
                <input id = "csrf_token" type="hidden" name="csrf">
                <tr id="id">
                    <td></td>
                    <td></td>
                </tr>
                <tr id = "name">
                    <td></td>
                    <td><input type="text" name="name" class="layui-input"  lay-verify="required">
                    </td>
                </tr>
                <tr id = "url">
                    <td></td>
                    <td><input type="text" name="url" class="layui-input">
                    </td>
                </tr>
                <tr id = "sort">
                    <td></td>
                    <td><input type="text" name="sort" class="layui-input"  lay-verify="number">
                    </td>
                </tr>
            </tbody>
        </table>
        *为必填项目
        </form>
        <div class="layui-tab layui-tab-brief">
            <ul class="layui-tab-title">
                <li class = "layui-this"><h2>明细列表</h2></li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <!-- 表工具栏 -->
                    <script type="text/html" id="toolbar"></script>
                    <!-- 行工具栏 -->
                    <script type="text/html" id="rowToolbar"></script>
                    <!-- 移动端 行工具栏 -->
                    <script type="text/html" id="rowToolbarMobile"></script>
                    <table id="table" class="layui-table layui-hide" lay-filter="table"></table>
                    <!-- 移动端 列显示内容 -->
                    <script type="text/html" id="mobileCol"></script>
                </div>
            </div>
        </div>
        <script src="/js/admin/permissionParent/update.js"></script>
        <script src="/js/admin/permissionParent/childList.js"></script>
    </div>
</body>
</html>