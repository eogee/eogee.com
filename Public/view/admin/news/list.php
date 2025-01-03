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
                    <li id = "recycle"><h2>回收站</h2></li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
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
                            <tbody id = "tbody"></tbody>
                        </table>
                        <button id = "eidtBtn" class="layui-btn">修改</button>
                        <br><br>
                    </div>
                </div>
            </div>                
        </div>            
    </div>
    <script src = "/js/admin/news/list.js"></script>
<?php
    View::view('/admin/foot');
?>  