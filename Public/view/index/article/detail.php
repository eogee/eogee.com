<?php
    $indexData = $data['indexData'];
    $list = $data['list'];
    $data = $data['data']['data'];
    
    use Easy\View\View;
    use Helper\Url;

    View::view('/index/head', $indexData);
?> 
<div class="eog-container">
    <div class="layui-container">
        <div class="layui-panel eog-side-nav">
            <ul class="layui-menu layui-menu-lg">
                <?php

                // 按类别对文章进行分组
                $categoryGroups = array();
                foreach ($list as $item) {
                    $categoryId = $item['categoryName'];
                    if (!isset($categoryGroups[$categoryId])) {
                        $categoryGroups[$categoryId] = array();
                    }
                    $categoryGroups[$categoryId][] = $item;
                }

                // 输出菜单
                foreach ($categoryGroups as $categoryName => $articles) :
                ?>
                <li class="layui-menu-item-group" lay-options="{type: 'group', isAllowSpread: true}">
                    <div class="layui-menu-body-title"><?= htmlspecialchars($categoryName) ?></div>
                    <ul>
                        <?php foreach ($articles as $article) : ?>
                        <li <?= Url::getId() == $article['id'] ? "class='layui-menu-item-checked2'" : "" ?>>
                            <div class="layui-menu-body-title">
                                <a href="/article/detail/<?= htmlspecialchars($article['id']) ?>">
                                    <span><?= htmlspecialchars($article['title']) ?></span>
                                </a>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <?php endforeach; ?>                
            </ul>
        </div>
        <div class="eog-mdContent">            
            <div id="preview"></div>            
            <div class = "eog-side">
                <div class="eog-side-fixed">                    
                    <ul class="layui-menu layui-menu-lg">
                        <li class="layui-menu-item-group layui-menu-item-up" lay-options="{type: 'group', isAllowSpread: true}">
                            <div class="layui-menu-body-title">本文目录>></div>
                            <ul class = "toc-menu" id = "toc"></ul>
                        </li>
                        <li class="layui-menu-item-group" lay-options="{type: 'group', isAllowSpread: true}">
                            <div class="layui-menu-body-title">文档及源码获取</div>
                            <ul>
                                <li>
                                    <div class="layui-menu-body-title">
                                        <a href="/article/detail/1">
                                            <span style = "font-weight: bold;">本站：EOGEE.COM</span> 
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <div class="layui-menu-body-title"> 
                                        <a>
                                            <span>1群589912610(已满)</span><br>
                                            <span>2群1032868416(已满)</span><br>
                                            <span>3群996553746</span>
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
                                <li>
                                    <div class="layui-menu-body-title">
                                        <a href="https://www.douyin.com/user/MS4wLjABAAAAdH5__CXhFJtSrDQKNuI_vh4mI4-LdyQ_LPKB4d9gR3gISMC_Ak0ApCjFYy_oxhfC" target="_blank">
                                            <span>抖音</span> 
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