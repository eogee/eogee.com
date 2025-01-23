<?php
    $indexData = $data['indexData'];
    $data = $data['data']['data'];
    use Easy\View\View;
    View::view('/index/head', $indexData);
?> 
<div class="eog-container">
    <div class="layui-container">
        <div class="layui-panel eog-side-nav">
            <ul class="layui-menu layui-menu-lg">
                <li class="layui-menu-item-group" lay-options="{type: 'group', isAllowSpread: true}">
                    <div class="layui-menu-body-title">前言</div>
                    <ul>
                        <li class="layui-menu-item-checked2">
                            <div class="layui-menu-body-title">
                                <a href="/docs/2/">
                                    <span>01 什么是WEB编程</span> 
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="layui-menu-body-title">
                                <a href="/docs/2/base.html">
                                    <span>02 代码编辑器与浏览器</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="layui-menu-item-group" lay-options="{type: 'group', isAllowSpread: true}">
                    <div class="layui-menu-body-title">WEB前端基础</div>
                    <ul>
                        <li>
                            <div class="layui-menu-body-title">
                                <a href="/docs/2/layout/">
                                    <span>03 HTML 核心知识</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
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
    /* 通过ajax获取文章内容 */
    fetch('/article/detailApi/' + <?= $data['id'];?>)
    .then(response => response.text())
    .then(data => {
        /* 渲染预览 */
        var editor = editormd.markdownToHTML("preview", {
            markdown: data, // Markdown内容
        });
    })
    .catch(error => console.error('Error:', error));
</script>
<?php
    View::view('/index/foot',$indexData);
?>