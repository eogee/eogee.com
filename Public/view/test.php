<?php
    use Easy\View\View;
    View::view('/admin/head');
?> 
    <div class="layui-body">
        <!-- 内容主体区域 -->
        <div style="padding: 15px;">
            <h1 id = "tableComment"></h1>
            <div class="layui-tab layui-tab-brief">
                <ul class="layui-tab-title">
                    <li id = "list"><h2>数据列表</h2></li>
                    <li id = "recycle"><h2>回收站</a></li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <!-- 搜索栏 -->
                        <form class="layui-form layui-row layui-col-space15" id = "search" method="get"></form>
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
                    <br><br>
                </div>
            </div>
        </div>
    </div>
    <script>
        layui.use(function() {
            var table = layui.table;
            // 表格初始化
            table.render({
                elem: '#table',
                url: '/test/listApi',
                toolbar: '#toolbar',
                cols: [[
                    {type: 'checkbox', fixed: 'left'},
                    {field: 'ip', title: 'IP', width: 80, fixed: 'left'},
                    {field: 'host', title: 'host',  fixed: 'left'},
                    {field: 'url', title: 'url', },
                    {field: 'username', title: 'username'},
                    {field: 'userId', title: 'userId'},
                    {field: 'method', title: 'method'},
                    {field: 'userAgent', title: 'userAgent'},
                    {field: 'referer', title: 'referer'},
                    {field: 'timestamp', title: 'timestamp'},
                    {fixed: 'right', title: '操作', align: 'center', toolbar: '#rowToolbar'}
                ]],
                page: true,
                text: {
                    none: '暂无数据'
                }
            });
        });
    </script>
<?php
    View::view('/admin/foot');
?>