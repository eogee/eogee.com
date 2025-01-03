<?php
    use Easy\View\View;
    View::view('/admin/updateHead');
?> 
    <tr>
        <td>颜色样式</td>
        <td>
            <span class="layui-badge layui-bg-black">黑色</span>
            <span class="layui-bg-rim">白色</span>
            <span class="layui-badge layui-bg-red">红色</span>
            <span class="layui-badge layui-bg-blue">蓝色</span>
            <span class="layui-badge layui-bg-green">绿色</span>
            <span class="layui-badge layui-bg-orange">橙色</span>
            <span class="layui-badge layui-bg-purple">紫色</span>
        </td>
    </tr>
    <tr id = "title">
        <td></td>
        <td><input type="text" name="title" class="layui-input" lay-verify="required">
        </td>
    </tr>
    <tr id = "titleSize">
        <td></td>
        <td>
        <select name="titleSize" lay-verify="required">
            <option value=""></option>
            <option value="h1">H1</option>
            <option value="h2">H2</option>
        </select>
        </td>
    </tr>
    <tr id = "titleColor">
        <td></td>
        <td>
            <select name = "titleColor" lay-verify="required">
                <option value=""></option>
                <option value="black">黑色</option>
                <option value="white">白色</option>
                <option value="red">红色</option>
                <option value="blue">蓝色</option>
                <option value="green">绿色</option>
                <option value="orange">橙色</option>
                <option value="purple">紫色</option>
            </select>
        </td>
    </tr>
    <tr id = "titleShadowColor">
        <td></td>
        <td><select name = "titleShadowColor" lay-verify="required">
                <option value=""></option>
                <option value="black">黑色</option>
                <option value="white">白色</option>
                <option value="red">红色</option>
                <option value="blue">蓝色</option>
                <option value="green">绿色</option>
                <option value="orange">橙色</option>
                <option value="purple">紫色</option>
            </select>
        </td>
    </tr>
    <tr id = "backgroundImage">
        <td></td>
        <td>
            <!-- 上传按钮 -->
            <button type="button" class="layui-btn  layui-btn-sm" id="backgroundImageBtn">
                <i class="layui-icon layui-icon-upload-circle"></i>上传
            </button>
            <div style="width: 100px;">
                <!-- 预览图 -->
                <div class="layui-upload-list">
                    <img class="layui-upload-img" id="backgroundImageImg">
                    <div id="backgroundImageText"></div>
                </div>
                <!-- 进度条 -->
                <div class="layui-progress layui-progress-big" lay-showPercent="yes" lay-filter="backgroundImageProgress">
                    <div class="layui-progress-bar" lay-percent=""></div>
                </div>
            </div>
            <div class="layui-word-aux">
                1024kb以下，建议上传3000:1200像素的png格式图片
            </div>
        </td>
    </tr>                
    <tr id = "keynote">
        <td></td>
        <td><input type="text" name="keynote" class="layui-input" lay-verify="required">
        </td>
    </tr>
    <tr id = "keynoteColor">
        <td></td>
        <td><select name = "keynoteColor">
                <option value=""></option>
                <option value="black">黑色</option>
                <option value="white">白色</option>
                <option value="red">红色</option>
                <option value="blue">蓝色</option>
                <option value="green">绿色</option>
                <option value="orange">橙色</option>
                <option value="purple">紫色</option>
            </select>
        </td>
    </tr>
    <tr id = "keynoteShadowColor">
        <td></td>
        <td><select name = "keynoteShadowColor">
                <option value=""></option>
                <option value="black">黑色</option>
                <option value="white">白色</option>
                <option value="red">红色</option>
                <option value="blue">蓝色</option>
                <option value="green">绿色</option>
                <option value="orange">橙色</option>
                <option value="purple">紫色</option>
            </select>
        </td>
    </tr>
    <tr id = "content">
        <td></td>
        <td><input type="text" name="content" class="layui-input" lay-verify="required">
        </td>
    </tr>
    <tr id = "contentColor">
        <td></td>
        <td><select name = "contentColor">
                <option value=""></option>
                <option value="black">黑色</option>
                <option value="white">白色</option>
                <option value="red">红色</option>
                <option value="blue">蓝色</option>
                <option value="green">绿色</option>
                <option value="orange">橙色</option>
                <option value="purple">紫色</option>
            </select>
        </td>
    </tr>
    <tr id = "contentShadowColor">
        <td></td>
        <td><select name = "contentShadowColor">
                <option value=""></option>
                <option value="black">黑色</option>
                <option value="white">白色</option>
                <option value="red">红色</option>
                <option value="blue">蓝色</option>
                <option value="green">绿色</option>
                <option value="orange">橙色</option>
                <option value="purple">紫色</option>
            </select>
        </td>
    </tr>
    <tr id = "btn1">
        <td></td>
        <td><input type="text" name="btn1" class="layui-input">
        </td>
    </tr>
    <tr id = "btn1url">
        <td></td>
        <td><input type="text" name="btn1url" class="layui-input">
        </td>
    </tr>
    <tr id = "btn1blank">
        <td></td>
        <td><select name="btn1blank">
                <option value=""></option>
                <option value="1">是</option>
                <option value="0">否</option>
            </select>
        </td>
    </tr>
    <tr id = "btn2">
        <td></td>
        <td><input type="text" name="btn2" class="layui-input">
        </td>
    </tr>
    <tr id = "btn2url">
        <td></td>
        <td><input type="text" name="btn2url" class="layui-input">
        </td>
    </tr>
    <tr id = "btn2blank">
        <td></td>
        <td><select name="btn2blank">
                <option value=""></option>
                <option value="1">是</option>
                <option value="0">否</option>
            </select>
        </td>
    </tr>
    <tr id = "sort">
        <td></td>
        <td><input type="text" name="sort" class="layui-input"  lay-verify="number">
        </td>
    </tr>
    <script src="/js/admin/carousel/update.js"></script>
<?php
    View::view('/admin/updateFoot');
?>