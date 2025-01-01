<?php
    use Helper\View;
    View::view('/admin/head');
?>   
    
        <div class="layui-body">
            <!-- 内容主体区域 -->
            <div style="padding: 15px;">
                <div class="layui-card">
                    <div class="layui-card-header">
                        提交站点
                    </div>
                    <div class="layui-card-body">
                        结果：<?=$result?>
                    </div>
                </div>
                <br><br>
            </div>
        </div>
<?php
    View::view('/admin/foot');
?>