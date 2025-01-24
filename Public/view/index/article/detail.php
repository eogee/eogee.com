<?php
    $indexData = $data['indexData'];
    $data = $data['data']['data'];
    use Easy\View\View;
    use Helper\Url;

    View::view('/index/head', $indexData);
?> 
<div class="eog-container">
    <div class="layui-container">
        <div class="layui-panel eog-side-nav">
            <ul class="layui-menu layui-menu-lg">
                <li class="layui-menu-item-group" lay-options="{type: 'group', isAllowSpread: true}">
                    <div class="layui-menu-body-title">前言</div>
                    <ul>
                        <li <?php $id = Url::getId(); echo  $id == 1 ? "class='layui-menu-item-checked2'" : ""; ?>>
                            <div class="layui-menu-body-title">
                                <a href="/article/detail/1">
                                    <span>01 什么是WEB编程</span> 
                                </a>
                            </div>
                        </li>
                        <li <?php $id = Url::getId(); echo  $id == 2 ? "class='layui-menu-item-checked2'" : ""; ?>>
                            <div class="layui-menu-body-title">
                                <a href="/article/detail/2">
                                    <span>02 代码编辑器与浏览器</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="layui-menu-item-group" lay-options="{type: 'group', isAllowSpread: true}">
                    <div class="layui-menu-body-title">WEB前端基础</div>
                    <ul>
                        <li <?php $id = Url::getId(); echo  $id == 3 ? "class='layui-menu-item-checked2'" : ""; ?>>
                            <div class="layui-menu-body-title">
                                <a href="/article/detail/3">
                                    <span>03 HTML 核心知识</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="eog-mdContent">            
            <div id="preview"></div>            
            <div class = "eog-side">
                <div class="eog-side-fixed">                    
                    <ul class="layui-menu layui-menu-lg">
                        <li class="layui-menu-item-group" lay-options="{type: 'group', isAllowSpread: true}">
                            <div class="layui-menu-body-title">本文目录</div>
                            <ul id = "toc"></ul>
                        </li>
                        <li class="layui-menu-item-group" lay-options="{type: 'group', isAllowSpread: true}">
                            <div class="layui-menu-body-title">讲义及源码获取</div>
                            <ul>
                                <li>
                                    <div class="layui-menu-body-title">
                                        <a href="/article/detail/1">
                                            <span>本站：EOGEE.COM</span> 
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <div class="layui-menu-body-title"> 
                                        <a>
                                            <span>QQ群：589912610</span>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <div class="layui-menu-body-title">
                                        <a href="https://gitee.com/eogee/webTutorial" target="_blank">
                                            <span>gitee开源平台</span>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <div class="layui-menu-body-title">
                                        <a href="https://github.com/eogee/webTutorial" target="_blank">
                                            <span>github开源平台</span>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="layui-menu-item-group" lay-options="{type: 'group', isAllowSpread: true}">
                            <div class="layui-menu-body-title">观看视频</div>
                            <ul>
                                <li>
                                    <div class="layui-menu-body-title">
                                        <a href="https://space.bilibili.com/315734619" target="_blank">
                                            <span>B站</span> 
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>               
            </div>
        </div>
        <div class="eog-menu-bar layui-bg-green layui-hide">
            <i class="layui-icon layui-icon-spread-left"></i>
        </div>
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
            toc: true,
            tocContainer: "#toc", // 目录容器ID
            tocStartLevel: 2 // 目录开始的层级
        });
    })
    .catch(error => console.error('Error:', error));

       
</script>
<?php
    View::view('/index/foot',$indexData);
?>