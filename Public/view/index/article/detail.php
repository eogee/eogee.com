<?php
    $indexData = $data;
    use Easy\View\View;
    View::view('/index/head', $indexData);
?> 
<div class="eog-container">
    <div class="layui-container eog-text">
        <div id="preview"></div>
    </div>
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
    /* 预览 */
    var editor = editormd.markdownToHTML("preview", {
        markdown: "```php echo 123;```", // Markdown内容
    });
</script>
<?php
    View::view('/index/foot',$indexData);
?>