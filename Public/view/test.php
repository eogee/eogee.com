<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>test</title>
    <link rel="stylesheet" href="/layui/css/layui.css">
    <!-- 引入编辑器的css文件 -->
    <link rel="stylesheet" href="/dist/editor.md/css/editormd.min.css" />
    <script src="/layui/layui.js"></script>
    <script src="/js/admin/eogee-admin-layui.js"></script>
</head>

<body>
    <div class="layui-container">
        <br><br>
        <div id="test-editormd">
            <textarea style="display:none;"></textarea>
        </div>
        <br><br>
    </div>
    
    <script src = "/dist/jquery/dist/jquery.min.js"></script>
    <script src = "/dist/editor.md/editormd.min.js"></script>
    <script>
        // 使用editor.md编辑器
        var testEditor = editormd("test-editormd", {
            width   : "100%",
            height  : 640,
            syncScrolling : "single",
            path    : "/dist/editor.md/lib/",
            imageUpload : true,
            imageFormats : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
            imageUploadURL : "/test/fileUploadApi",
            /* onload : function() {
                this.fullscreen();
            } */
        });
    </script>
</body>
</html>
