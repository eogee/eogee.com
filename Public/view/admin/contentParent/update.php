<!DOCTYPE html>
<html>
<head>
    <title>更新数据</title>
    <link rel="stylesheet" href="/layui/css/layui.css" rel="stylesheet">
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
                <tr id="id">
                    <td></td>
                    <td></td>
                </tr>
                <tr id = "top">
                    <td></td>
                    <td><select name="top">
                        <option value=""></option>
                        <option value="1">是</option>
                        <option value="0">否</option>
                    </select>
                    </td>
                </tr>
                <tr id = "isNews">
                    <td></td>
                    <td><select name="isNews">
                        <option value=""></option>
                        <option value="1">是</option>
                        <option value="0">否</option>
                    </select>
                    </td>
                </tr>
                <tr id = "style">
                    <td></td>
                    <td><input type="text" name="style" class="layui-input">
                    </td>
                </tr>
                <tr id = "title">
                    <td></td>
                    <td><input type="text" name="title" class="layui-input" lay-verify="required">
                    </td>
                </tr>                
                <tr id = "titleAbbre">
                    <td></td>
                    <td><input type="text" name="titleAbbre" class="layui-input" lay-verify="required">
                    </td>
                </tr>
                <tr id = "titleColor">
                    <td></td>
                    <td><select name="titleColor">
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
                    <td><select name="titleShadowColor">
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
                <tr id = "keywords">
                    <td></td>
                    <td><input type="text" name="keywords" class="layui-input">
                        <div class="layui-word-aux">
                            用于seo优化，多个关键字请用英文逗号隔开
                        </div>
                    </td>
                </tr>                
                <tr id = "description">
                    <td></td>
                    <td><input type="text" name="description" class="layui-input">
                        <div class="layui-word-aux">
                            用于seo优化，描述内容请简短，不超过150字
                        </div>
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
                    <td><select name="keynoteColor">
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
                    <td><select name="keynoteShadowColor">
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
                <tr id = "lastChildTitle">
                    <td></td>
                    <td><input type="text" name="lastChildTitle" class="layui-input" lay-verify="required">
                    </td>
                </tr>
                <tr id = "lastChildTitleAbbre">
                    <td></td>
                    <td><input type="text" name="lastChildTitleAbbre" class="layui-input" lay-verify="required">
                    </td>
                </tr>
                <tr id = "lastChildTitleUrl">
                    <td></td>
                    <td><input type="text" name="lastChildTitleUrl" class="layui-input" lay-verify="required">
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
        <script src="/js/admin/contentParent/update.js"></script>
        <script src="/js/admin/contentParent/childList.js"></script>
    </div>
</body>
</html>