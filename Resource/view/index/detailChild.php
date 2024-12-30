<?php
    require_once 'Resource/view/index/head.php';
?>
    
    <div class="eog-container eog-index-main">
        <div class = "eog-image-background-half" style = "background-image:url('<?=$data['data']['backgroundImage']?>')">
            <div class="layui-container  eog-text">
                <h1 class = "<?= $data['data']['top'] ? 'padding-top-60' : null ?> layui-font-<?=$data['data']['titleColor']?> eog-text-shadow-<?=$data['data']['titleShadowColor']?>"><?=$data['data']['title']?></h1>
                <h3 class = "layui-font-<?=$data['data']['keynoteColor']?> eog-text-shadow-<?=$data['data']['keynoteShadowColor']?>"><?=$data['data']['keynote']?></h3>
            </div>
        </div>
        <div class="layui-container  eog-text">
            <p class = "layui-font-<?=$data['data']['contentColor']?> eog-text-shadow-<?=$data['data']['contentShadowColor']?>"><?=$data['data']['content']?></p>
            <p class = "layui-font-<?=$data['data']['detailColor']?> eog-text-shadow-<?=$data['data']['detailShadowColor']?>"><?=$data['data']['detail']?></p>
        </div>
    </div>
<?php
    require_once 'Resource/view/index/foot.php';
?>