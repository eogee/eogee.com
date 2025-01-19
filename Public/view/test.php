<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>test</title>
    <link rel="stylesheet" href="/layui/css/layui.css">    
    <link rel="stylesheet" href="/dist/editor.md/css/editormd.min.css" /><!-- 引入编辑器的css文件 -->
    <link rel="stylesheet" href="/dist/editor.md/css/editormd.preview.css" />
    <script src="/layui/layui.js"></script>
    <script src="/js/admin/eogee-admin-layui.js"></script>
</head>

<body>
    <div class="layui-container">
        <br><br>
        <div id="test-editormd">
            <textarea name="content" style="display:none;"></textarea>
        </div>
        <div id="preview"></div>
        <br><br>
    </div>
    <!-- jquery -->
    <script src = "/dist/jquery/dist/jquery.min.js"></script>
    <!-- editor.md 核心js -->
    <script src = "/dist/editor.md/lib/marked.min.js"></script>
    <script src = "/dist/editor.md/lib/prettify.min.js"></script>
    <script src = "/dist/editor.md/lib/raphael.min.js"></script>
    <script src = "/dist/editor.md/lib/underscore.min.js"></script>
    <script src = "/dist/editor.md/lib/flowchart.min.js"></script>
    <script src = "/dist/editor.md/lib/sequence-diagram.min.js"></script>
    <script src = "/dist/editor.md/lib/jquery.flowchart.min.js"></script>
    <!-- editor.md js -->
    <script src = "/dist/editor.md/editormd.min.js"></script>
    <script>
        /* 初始化编辑器 */
        var editor = editormd("test-editormd", {
            width: "100%",
            height: "600px",
            path: "/dist/editor.md/lib/", // editormd的lib目录路径
            // 其他配置项
            imageUpload: true,
            imageUploadURL: "/test/fileUploadApi", // 上传图片的URL
        });

        /* 预览 */
        var editor = editormd.markdownToHTML("preview", {
            markdown: "Hello world!", // Markdown内容
        });
    </script>
</body>
</html>
