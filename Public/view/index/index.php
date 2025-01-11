<?php
    $indexData = $data['indexData'];
    use Easy\View\View;
    View::view('/index/head', $indexData);

    $carousel = $data['carousel'];
    $content = $data['content'];
    $news = $data['news'];
?> 
    
    <div class="eog-container eog-index-main eog-text">
        <!-- 轮播 -->
        <div class="layui-carousel" id="indexCarousel">
            <div carousel-item><?php
            for ($i = 0; $i < count($carousel); $i++) { ?>

                <div class="eog-image-background" style="background-image:url('<?= $carousel[$i]['backgroundImage'] ?>')">
                    <<?= $carousel[$i]['titleSize'] ?> class="padding-top-carousel layui-font-<?= $carousel[$i]['titleColor'] ?> eog-text-shadow-<?= $carousel[$i]['titleShadowColor'] ?>"><?= $carousel[$i]['title'] ?></<?= $carousel[$i]['titleSize'] ?>>
                    <h3 class="layui-font-<?= $carousel[$i]['keynoteColor'] ?> eog-text-shadow-<?= $carousel[$i]['keynoteShadowColor'] ?>"><?= $carousel[$i]['keynote'] ?></h3>
                    <h4 class="layui-font-<?= $carousel[$i]['contentColor'] ?> eog-text-shadow-<?= $carousel[$i]['contentShadowColor'] ?>"><?= $carousel[$i]['content'] ?></h4><?php 
                    if ($carousel[$i]['btn1'] != null) { 
                        if ($carousel[$i]['btn2blank'] == 1) { ?>

                    <button onclick="window.open('<?= $carousel[$i]['btn1url'] ?>','_blank')" class="layui-btn layui-btn-sm"><?= $carousel[$i]['btn1'] ?></button><?php }else{ ?>

                    <button onclick="window.location.href='<?= $carousel[$i]['btn1url'] ?>'" class="layui-btn layui-btn-sm"><?= $carousel[$i]['btn1'] ?></button><?php } } 
                    if ($carousel[$i]['btn2'] != null) { 
                        if ($carousel[$i]['btn2blank'] == 1) { ?>

                    <button onclick="window.open('<?= $carousel[$i]['btn2url'] ?>','_blank')" class="layui-btn layui-btn-sm layui-btn-primary layui-border-green"><?= $carousel[$i]['btn2'] ?></button><?php }else{ ?>

                    <button onclick="window.location.href='<?= $carousel[$i]['btn2url'] ?>'" class="layui-btn layui-btn-sm layui-btn-primary layui-border-green"><?= $carousel[$i]['btn2'] ?></button><?php } } ?>

                </div><?php } ?>

            </div>
        </div>
        <div class="layui-container eog-text">
            <div class="layui-row layui-col-space15"><?php
                for ($i = 0; $i < count($content[0]['childData']); $i++) { ?>

                <div class="layui-col-md4">
                    <div class="layui-panel eog-panel">
                        <div class="eog-image-card" style="background-image:url('<?= $content[0]['childData'][$i]['backgroundImage'] ?>')">
                            <h4 class="layui-font-<?= $content[0]['childData'][$i]['titleColor'] ?> eog-text-shadow-<?= $content[0]['childData'][$i]['titleShadowColor'] ?>">
                                <?= $content[0]['childData'][$i]['title'] ?>

                            </h4>
                            <h5 class="layui-font-<?= $content[0]['childData'][$i]['contentColor'] ?> eog-text-shadow-<?= $content[0]['childData'][$i]['contentShadowColor'] ?>">
                                <?= $content[0]['childData'][$i]['content'] ?>

                            </h5><?php
                                    if ($content[0]['childData'][$i]['btn1'] != null) { 
                                        if ($content[0]['childData'][$i]['btn1blank'] == 1) { ?>

                                <button onclick="window.open('<?= $content[0]['childData'][$i]['btn1url'] ?>','_blank')" class="layui-btn layui-btn-sm"><?= $content[0]['childData'][$i]['btn1'] ?></button><?php }else{ ?>

                                <button onclick="window.location.href='<?= $content[0]['childData'][$i]['btn1url'] ?>'" class="layui-btn layui-btn-sm"><?= $content[0]['childData'][$i]['btn1'] ?></button><?php } } 
                                    if ($content[0]['childData'][$i]['btn2'] != null) { 
                                        if ($content[0]['childData'][$i]['btn2blank'] == 1) { ?>

                                <button onclick="window.open('<?= $content[0]['childData'][$i]['btn2url'] ?>','_blank')" class="layui-btn layui-btn-primary layui-border-green layui-btn-sm"><?= $content[0]['childData'][$i]['btn2'] ?></button><?php }else{ ?>

                                <button onclick="window.location.href='<?= $content[0]['childData'][$i]['btn2url'] ?>'" class="layui-btn layui-btn-primary layui-border-green layui-btn-sm"><?= $content[0]['childData'][$i]['btn2'] ?></button><?php } } ?>

                        </div>
                    </div>
                </div><?php } ?>
            </div>
            <div class="layui-row eog-image-background" style="background-image:url('<?= $content[1]['backgroundImage'] ?>')">
                <div class="card-title">
                    <h3><?= $content[1]['title'] ?></h3>
                    <h4><?= $content[1]['keynote'] ?></h4>
                </div>
                <div class="layui-row min-height-400">
                    <div class="layui-col-md3">
                        <ul class="layui-nav layui-nav-tree" id="tabHeader<?= $content[1]['id'] ?>"><?php
                        for ($i = 0; $i < count($content[1]['childData']); $i++) {
                            if ($i == 0) { ?>

                            <li class="layui-nav-item layui-this">
                                <a href="javascript:;"><span class="fullName"><?= $content[1]['childData'][$i]['title'] ?></span><span class="abbreName layui-hide"><?= $content[1]['childData'][$i]['titleAbbre'] ?></span></a>
                            </li><?php } else { ?>

                            <li class="layui-nav-item">
                                <a href="javascript:;"><span class="fullName"><?= $content[1]['childData'][$i]['title'] ?></span><span class="abbreName layui-hide"><?= $content[1]['childData'][$i]['titleAbbre'] ?></span></a>
                            </li><?php } 
                            } ?>

                            <li class="layui-nav-item">
                                <a href="/contentParent/detail/<?= $content[1]['id'] ?>"><span class="fullName"><?= $content[1]['lastChildTitle'] ?></span><span class="abbreName layui-hide"><?= $content[1]['lastChildTitleAbbre'] ?></span>>></a>
                            </li>
                        </ul>
                    </div>
                    <div class="layui-col-md9 eog-tab-body" id="tabBody<?= $content[1]['id'] ?>"><?php
                        for ($i = 0; $i < count($content[1]['childData']); $i++) {
                            if ($i == 0) { ?>

                        <div class="layui-anim layui-anim-scale min-height-400 layui-show"><?php } else { ?>

                        <div class="layui-anim layui-anim-scale min-height-400"><?php } ?>

                            <h3 class="layui-font-<?= $content[1]['childData'][$i]['titleColor'] ?> <?= $content[1]['childData'][$i]['top'] ? 'padding-top-60' : null ?> eog-text-shadow-<?= $content[1]['childData'][$i]['titleShadowColor'] ?>">
                                <?= $content[1]['childData'][$i]['title'] ?>

                            </h3>
                            <h3 class="layui-font-<?= $content[1]['childData'][$i]['keynoteColor'] ?> eog-text-shadow-<?= $content[1]['childData'][$i]['keynoteShadowColor'] ?>">
                                <?= $content[1]['childData'][$i]['keynote'] ?>

                            </h3>
                            <h4 class="layui-font-<?= $content[1]['childData'][$i]['contentColor'] ?> eog-text-shadow-<?= $content[1]['childData'][$i]['contentShadowColor'] ?>">
                                <?= $content[1]['childData'][$i]['content'] ?>

                            </h4>
                            <p class="layui-font-<?= $content[1]['childData'][$i]['detailColor'] ?> eog-text-shadow-<?= $content[1]['childData'][$i]['detailShadowColor'] ?>">
                                <?= $content[1]['childData'][$i]['detail'] ?>

                            </p><?php
                                if ($content[1]['childData'][$i]['btn1'] != null) { 
                                    if ($content[1]['childData'][$i]['btn1blank'] == 1) { ?>

                            <button onclick="window.open('<?= $content[1]['childData'][$i]['btn1url'] ?>','_blank')" class="layui-btn layui-btn-sm"><?= $content[1]['childData'][$i]['btn1'] ?></button><?php }else{ ?>

                            <button onclick="window.location.href='<?= $content[1]['childData'][$i]['btn1url'] ?>'" class="layui-btn layui-btn-sm"><?= $content[1]['childData'][$i]['btn1'] ?></button><?php } } 
                                if ($content[1]['childData'][$i]['btn2'] != null) { 
                                    if ($content[1]['childData'][$i]['btn2blank'] == 1) { ?>

                            <button onclick="window.open('<?= $content[1]['childData'][$i]['btn2url'] ?>','_blank')" class="layui-btn layui-btn-primary layui-border-green layui-btn-sm"><?= $content[1]['childData'][$i]['btn2'] ?></button><?php }else{ ?>

                            <button onclick="window.location.href='<?= $content[1]['childData'][$i]['btn2url'] ?>'" class="layui-btn layui-btn-primary layui-border-green layui-btn-sm"><?= $content[1]['childData'][$i]['btn2'] ?></button><?php } } ?>

                        </div><?php } ?>

                    </div>
                </div>
            </div>
            <div class="layui-row eog-image-background" style="background-image:url('<?= $content[2]['backgroundImage'] ?>')">
                <div class="card-title">
                    <h3><?= $content[2]['title'] ?></h3>
                    <h4><?= $content[2]['keynote'] ?></h4>
                </div>
                <div class="layui-row min-height-400">
                    <div class="layui-col-md3">
                        <ul class="layui-nav layui-nav-tree" id="tabHeader<?= $content[2]['id'] ?>"><?php
                        for ($i = 0; $i < count($content[2]['childData']); $i++) {
                            if ($i == 0) { ?>

                            <li class="layui-nav-item layui-this">
                                <a href="javascript:;"><span class="fullName"><?= $content[2]['childData'][$i]['title'] ?></span><span class="abbreName layui-hide"><?= $content[2]['childData'][$i]['titleAbbre'] ?></span></a>
                            </li><?php } else { ?>

                            <li class="layui-nav-item">
                                <a href="javascript:;"><span class="fullName"><?= $content[2]['childData'][$i]['title'] ?></span><span class="abbreName layui-hide"><?= $content[2]['childData'][$i]['titleAbbre'] ?></span></a>
                            </li><?php } 
                            } ?>

                            <li class="layui-nav-item">
                                <a href="/contentParent/detail/<?= $content[2]['id'] ?>"><span class="fullName"><?= $content[2]['lastChildTitle'] ?></span><span class="abbreName layui-hide"><?= $content[2]['lastChildTitleAbbre'] ?></span>>></a>
                            </li>
                        </ul>
                    </div>
                    <div class="layui-col-md9 eog-tab-body" id="tabBody<?= $content[2]['id'] ?>"><?php
                        for ($i = 0; $i < count($content[2]['childData']); $i++) {
                            if ($i == 0) { ?>

                        <div class="layui-anim layui-anim-scale min-height-400 layui-show"><?php } else { ?>

                        <div class="layui-anim layui-anim-scale min-height-400"><?php } ?>

                            <h3 class="layui-font-<?= $content[2]['childData'][$i]['titleColor'] ?> <?= $content[2]['childData'][$i]['top'] ? 'padding-top-60' : null ?> eog-text-shadow-<?= $content[2]['childData'][$i]['titleShadowColor'] ?>">
                                <?= $content[2]['childData'][$i]['title'] ?>

                            </h3>
                            <h3 class="layui-font-<?= $content[2]['childData'][$i]['keynoteColor'] ?> eog-text-shadow-<?= $content[2]['childData'][$i]['keynoteShadowColor'] ?>">
                                <?= $content[2]['childData'][$i]['keynote'] ?>

                            </h3>
                            <h4 class="layui-font-<?= $content[2]['childData'][$i]['contentColor'] ?> eog-text-shadow-<?= $content[2]['childData'][$i]['contentShadowColor'] ?>">
                                <?= $content[2]['childData'][$i]['content'] ?>

                            </h4>
                            <p class="layui-font-<?= $content[2]['childData'][$i]['detailColor'] ?> eog-text-shadow-<?= $content[2]['childData'][$i]['detailShadowColor'] ?>">
                                <?= $content[2]['childData'][$i]['detail'] ?>

                            </p><?php
                                if ($content[2]['childData'][$i]['btn1'] != null) { 
                                    if ($content[2]['childData'][$i]['btn1blank'] == 1) { ?>
                            
                            <button onclick="window.open('<?= $content[2]['childData'][$i]['btn1url'] ?>','_blank')" class="layui-btn layui-btn-sm"><?= $content[2]['childData'][$i]['btn1'] ?></button><?php }else{ ?>
                            
                            <button onclick="window.location.href='<?= $content[2]['childData'][$i]['btn1url'] ?>'" class="layui-btn layui-btn-sm"><?= $content[2]['childData'][$i]['btn1'] ?></button><?php } } 
                                if ($content[2]['childData'][$i]['btn2'] != null) { 
                                    if ($content[2]['childData'][$i]['btn2blank'] == 1) { ?>
                            
                            <button onclick="window.open('<?= $content[2]['childData'][$i]['btn2url'] ?>','_blank')" class="layui-btn layui-btn-primary layui-border-green layui-btn-sm"><?= $content[2]['childData'][$i]['btn2'] ?></button><?php }else{ ?>
                            
                            <button onclick="window.location.href='<?= $content[2]['childData'][$i]['btn2url'] ?>'" class="layui-btn layui-btn-primary layui-border-green layui-btn-sm"><?= $content[2]['childData'][$i]['btn2'] ?></button><?php } } ?>

                        </div><?php } ?>

                    </div>
                </div>
            </div>
            <div class="layui-row eog-image-background" style="background-image:url('<?= $content[3]['backgroundImage'] ?>')">
                <div class="card-title">
                    <h3><?= $content[3]['title'] ?></h3>
                    <h4><?= $content[3]['keynote'] ?></h4>
                </div>
                <div class="layui-row min-height-400">
                    <div class="layui-col-md3">
                        <ul class="layui-nav layui-nav-tree" id="tabHeader<?= $content[3]['id'] ?>"><?php
                        for ($i = 0; $i < count($content[3]['childData']); $i++) {
                            if ($i == 0) { ?>

                            <li class="layui-nav-item layui-this">
                                <a href="javascript:;"><span class="fullName"><?= $content[3]['childData'][$i]['title'] ?></span><span class="abbreName layui-hide"><?= $content[3]['childData'][$i]['titleAbbre'] ?></span></a>
                            </li><?php } else { ?>

                            <li class="layui-nav-item">
                                <a href="javascript:;"><span class="fullName"><?= $content[3]['childData'][$i]['title'] ?></span><span class="abbreName layui-hide"><?= $content[3]['childData'][$i]['titleAbbre'] ?></span></a>
                            </li><?php } 
                            } ?>

                            <li class="layui-nav-item">
                                <a href="/contentParent/detail/<?= $content[3]['id'] ?>"><span class="fullName"><?= $content[3]['lastChildTitle'] ?></span><span class="abbreName layui-hide"><?= $content[3]['lastChildTitleAbbre'] ?></span>>></a>
                            </li>
                        </ul>
                    </div>
                    <div class="layui-col-md9 eog-tab-body" id="tabBody<?= $content[3]['id'] ?>"><?php
                        for ($i = 0; $i < count($content[3]['childData']); $i++) {
                            if ($i == 0) { ?>

                        <div class="layui-anim layui-anim-scale min-height-400 layui-show"><?php } else { ?>

                        <div class="layui-anim layui-anim-scale min-height-400"><?php } ?>

                            <h3 class="layui-font-<?= $content[3]['childData'][$i]['titleColor'] ?> <?= $content[3]['childData'][$i]['top'] ? 'padding-top-60' : null ?> eog-text-shadow-<?= $content[3]['childData'][$i]['titleShadowColor'] ?>">
                                <?= $content[3]['childData'][$i]['title'] ?>

                            </h3>
                            <h3 class="layui-font-<?= $content[3]['childData'][$i]['keynoteColor'] ?> eog-text-shadow-<?= $content[3]['childData'][$i]['keynoteShadowColor'] ?>">
                                <?= $content[3]['childData'][$i]['keynote'] ?>

                            </h3>
                            <h4 class="layui-font-<?= $content[3]['childData'][$i]['contentColor'] ?> eog-text-shadow-<?= $content[3]['childData'][$i]['contentShadowColor'] ?>">
                                <?= $content[3]['childData'][$i]['content'] ?>

                            </h4>
                            <p class="layui-font-<?= $content[3]['childData'][$i]['detailColor'] ?> eog-text-shadow-<?= $content[3]['childData'][$i]['detailShadowColor'] ?>">
                                <?= $content[3]['childData'][$i]['detail'] ?>

                            </p><?php
                                if ($content[3]['childData'][$i]['btn1'] != null) { 
                                    if ($content[3]['childData'][$i]['btn1blank'] == 1) { ?>

                            <button onclick="window.open('<?= $content[3]['childData'][$i]['btn1url'] ?>','_blank')" class="layui-btn layui-btn-sm"><?= $content[3]['childData'][$i]['btn1'] ?></button><?php }else{ ?>

                            <button><a href="javascript:;" onclick="window.location.href='<?= $content[3]['childData'][$i]['btn1url'] ?>'"><?= $content[3]['childData'][$i]['btn1'] ?></a></button><?php } } 
                                if ($content[3]['childData'][$i]['btn2'] != null) { 
                                    if ($content[3]['childData'][$i]['btn2blank'] == 1) { ?>

                            <button onclick="window.open('<?= $content[3]['childData'][$i]['btn2url'] ?>','_blank')" class="layui-btn layui-btn-primary layui-border-green layui-btn-sm"><?= $content[3]['childData'][$i]['btn2'] ?></button><?php }else{ ?>

                            <button><a href="javascript:;" onclick="window.location.href='<?= $content[3]['childData'][$i]['btn2url'] ?>'"><?= $content[3]['childData'][$i]['btn2'] ?></a></button><?php } } ?>

                        </div><?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="layui-container eog-text">
        <div class="layui-row layui-col-space15">
            <div class="card-title" style="padding-bottom: 0px;">
                <h3><?=$news['info']['data']['title']?></h3>
                <h4><?=$news['info']['data']['keynote'] ?></h4>
            </div><?php
            $newsNum = count($news['data']) > 4 ? 4 : count($news['data']);
            $mdNum = 12/$newsNum;
            for ($i = 0; $i < $newsNum ; $i++) { ?>

            <div class="layui-col-md<?=$mdNum?>">
                <fieldset class="layui-elem-field">
                    <legend>
                        <h4><?=$news['data'][$i]['title']?>最新动态</h4>
                    </legend>
                    <div class="layui-field-box">
                        <div class="layui-timeline"><?php                            
                            foreach ($news['data'][$i]['childData'] as $key => $value) { ?>

                            <div class="layui-timeline-item">
                                <i class="layui-icon layui-timeline-axis"></i>
                                <div class="layui-timeline-content">
                                    <h4 class="layui-timeline-title no-margin no-padding"><?=$value['newsDate']?></h4>
                                    <p><?=$value['newsContent']?><a href="/content/detailChild/<?=$value['id']?>">详情</a>
                                    </p>
                                </div>
                            </div><?php } ?>

                        </div>
                    </div>
                </fieldset>
            </div><?php } ?>

        </div>
    </div>
    <script>
        // 轮播图
        carousel('indexCarousel');
        // 自定义选项卡
        tabIndex('<?= $content[1]['id'] ?>');
        tabIndex('<?= $content[2]['id'] ?>');
        tabIndex('<?= $content[3]['id'] ?>');

        var login = document.getElementById('login')
            login.onclick = function() {
                layui.use(function() {
                var layer = layui.layer;
                layer.open({
                    title: '登陆/注册',
                    type: 2,
                    area: ['400px', '550px'],
                    content: '/index/login',
                    end: function() {
                        window.location.reload();
                    }
                });
            });
        }
        
    </script>
<?php
    View::view('/index/foot',$indexData);
?>