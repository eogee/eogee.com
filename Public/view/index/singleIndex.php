<?php
    $indexData = $data['indexData'];
    use Helper\View;
    View::view('/index/head', $indexData);

    $data = $data['data'];
?> 
    
    <div class="eog-container">
        <div class = "eog-image-background-half" style = "background-image:url('<?=$data['backgroundImage']?>')">
            <div class="layui-container eog-index-main eog-text">
                <h1 class = "<?= $data['top'] ? 'padding-top-60' : null ?> layui-font-<?=$data['titleColor']?> eog-text-shadow-<?=$data['titleShadowColor']?>"><?=$data['title']?></h1>
                <h3 class = "layui-font-<?=$data['keynoteColor']?> eog-text-shadow-<?=$data['keynoteShadowColor']?>"><?=$data['keynote']?></h3>
            </div>
        </div>
        <div class="layui-container  eog-text">
            <p class = "layui-font-<?=$data['contentColor']?> eog-text-shadow-<?=$data['contentShadowColor']?>"><?=$data['content']?></p>
            <p class = "layui-font-<?=$data['detailColor']?> eog-text-shadow-<?=$data['detailShadowColor']?>"><?=$data['detail']?></p>
        </div>
    </div>
<?php
    View::view('/index/foot',$indexData);
?>