<?php
    use Helper\View;
    View::view('/admin/updateHead');
?> 
    <tr id="title">
        <td></td>
        <td><input type="text" name="title" class="layui-input" lay-verify="required"></td>
    </tr>
    <tr id="titleIcon">
        <td></td>
        <td>        
            <!-- 上传按钮 -->
            <button type="button" class="layui-btn  layui-btn-sm" id="titleIconBtn">
                <i class="layui-icon layui-icon-upload-circle"></i>上传
            </button>
            <div style="width: 100px;">
                <!-- 预览图 -->
                <div class="layui-upload-list">
                    <img class="layui-upload-img" id="titleIconImg">
                    <div id="titleIconText"></div>
                </div>
                <!-- 进度条 -->
                <div class="layui-progress layui-progress-big" lay-showPercent="yes" lay-filter="titleIconProgress">
                    <div class="layui-progress-bar" lay-percent=""></div>
                </div>
            </div>
            <div class="layui-word-aux">
                1024kb以下，上传ico格式图片
            </div>
        </td>
    </tr>
    <tr id="indexUrl">
        <td></td>
        <td><input type="text" name="indexUrl" class="layui-input" lay-verify="required"></td>
    </tr>
    <tr id="keywords">
        <td></td>
        <td><input type="text" name="keywords" class="layui-input" lay-verify="required"></td>
    </tr>
    <tr id="description">
        <td></td>
        <td><input type="text" name="description" class="layui-input" lay-verify="required"></td>
    </tr>
    <tr id="logoImage">
        <td></td>
        <td>
            <!-- 上传按钮 -->
            <button type="button" class="layui-btn  layui-btn-sm" id="logoImageBtn">
                <i class="layui-icon layui-icon-upload-circle"></i>上传
            </button>
            <div style="width: 100px;">
                <!-- 预览图 -->
                <div class="layui-upload-list">
                    <img class="layui-upload-img" id="logoImageImg">
                    <div id="logoImageText"></div>
                </div>
                <!-- 进度条 -->
                <div class="layui-progress layui-progress-big" lay-showPercent="yes" lay-filter="logoImageProgress">
                    <div class="layui-progress-bar" lay-percent=""></div>
                </div>
            </div>
            <div class="layui-word-aux">
                1024kb以下，建议上传3000:1200像素的png格式图片
            </div>
        </td>
    </tr>
    <tr id="logoAlt">
        <td></td>
        <td><input type="text" name="logoAlt" class="layui-input" lay-verify="required"></td>
    </tr>
    <tr id="navToolName">
        <td></td>
        <td><input type="text" name="navToolName" class="layui-input" lay-verify="required"></td>
    </tr>
    <tr id="navToolUrl">
        <td></td>
        <td><input type="text" name="navToolUrl" class="layui-input" lay-verify="required"></td>
    </tr>
    <tr id="singlePageName">
        <td></td>
        <td><input type="text" name="singlePageName" class="layui-input"></td>
    </tr>
    <tr id="copyright">
        <td></td>
        <td><input type="text" name="copyright" class="layui-input"></td>
    </tr>
    <tr id="siteName">
        <td></td>
        <td><input type="text" name="siteName" class="layui-input"></td>
    </tr>
    <tr id="recordCode">
        <td></td>
        <td><input type="text" name="recordCode" class="layui-input"></td>
    </tr>
    <script src="/js/admin/basicInfo/update.js"></script>
<?php
    View::view('/admin/updateFoot');
?>