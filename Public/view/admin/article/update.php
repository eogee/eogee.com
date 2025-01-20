<?php
    use Easy\View\View;
    View::view('/admin/updateHead');
?>
    <tr id = "title">
        <td></td>
        <td>
            <input type = "text" name = "title" class="layui-input" lay-verify="required">
        </td>
    </tr>
    <tr id = "keywords">
        <td></td>
        <td>
            <input type = "text" name = "keywords" class="layui-input" lay-verify="required">
        </td>
    </tr>
    <tr id = "description">
        <td></td>
        <td>
            <input type = "text" name = "description" class="layui-input" lay-verify="required">
        </td>
    </tr>
    <div id = "content">
        <textarea name = "content" lay-verify="required" style="display:none;"></textarea>
    </div>
    <tr id = "authorId">
        <td></td>
        <td>
            <input type = "text" name = "authorId" class="layui-input" lay-verify="required">
        </td>        
    </tr>
    <tr id = "authorUsername">
        <td></td>
        <td>
            <input type = "text" name = "authorUsername" class="layui-input" lay-verify="required">
        </td>
        
    </tr>
    <tr id = "authorNickname">
        <td></td>
        <td>
            <input type = "text" name = "authorNickname" class="layui-input" lay-verify="required">
        </td>        
    </tr>
    <tr id = "categoryId">
        <td></td>
        <td>
            <input type = "text" name = "categoryId" class="layui-input" lay-verify="required">
        </td>        
    </tr>
    <tr id = "categoryName">
        <td></td>
        <td>
            <input type = "text" name = "categoryName" class="layui-input" lay-verify="required">
        </td>        
    </tr>
    <tr id = "sort">
        <td></td>
        <td>
            <input type = "text" name = "sort" class="layui-input"  lay-verify="number">
        </td>        
    </tr>
    <script src = "/js/admin/article/update.js"></script>
    <!-- jquery -->
    <script src = "/dist/jquery/dist/jquery.min.js"></script>
    <!-- editor.md js -->
    <script src = "/dist/editor.md/editormd.min.js"></script>
    <script>
        /* 初始化编辑器 */
        var editor = editormd("content", {
            height: "600px",
            path: "/dist/editor.md/lib/", // editormd的lib目录路径
            // 其他配置项
            imageUpload: true,
            imageUploadURL: "/article/fileUploadApi", // 上传图片的URL
        });
    </script>
<?php
    View::view('/admin/updateFoot');
?>