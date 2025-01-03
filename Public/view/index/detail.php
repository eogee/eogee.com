<?php
    $indexData = $data['indexData'];
    use Easy\View\View;
    View::view('/index/head', $indexData);

    $data = $data['data'];
?> 
    
    <div class="eog-container eog-index-main">
        <div class = "eog-image-background-half" style = "background-image:url('<?=$data['data'][0]['backgroundImage']?>')">
            <div class="layui-container  eog-text">
                <h1 class = "<?= $data['data'][0]['top'] ? 'padding-top-60' : null ?> layui-font-<?=$data['data'][0]['titleColor']?> eog-text-shadow-<?=$data['data'][0]['titleShadowColor']?>"><?=$data['data'][0]['title']?></h1>
                <h3 class = "layui-font-<?=$data['data'][0]['keynoteColor']?> eog-text-shadow-<?=$data['data'][0]['keynoteShadowColor']?>"><?=$data['data'][0]['keynote']?></h3>
            </div>
        </div>
        <div class="layui-container eog-text">
            <div class="layui-row layui-col-space15 eog-panel"><?php
                for($i = 0 ; $i < count($data['childData']); $i++){?>

                <div class = "layui-col-md6">
                    <div class="layui-panel">
                        <div class="eog-image-card" style = "background-image:url('<?=$data['childData'][$i]['backgroundImage']?>')">
                            <h4 class="layui-font-<?=$data['childData'][$i]['titleColor']?> eog-text-shadow-<?=$data['childData'][$i]['titleShadowColor']?>">
                            <?=$data['childData'][$i]['title']?>

                            </h4>
                            <h5 class="layui-font-<?=$data['childData'][$i]['contentColor']?> eog-text-shadow-<?=$data['childData'][$i]['contentShadowColor']?>">
                                <?=$data['childData'][$i]['content']?>
                            
                            </h5><?php
                            if($data['childData'][$i]['btn1'] != null){ 
                                if($data['childData'][$i]['btn1blank'] == 1){?>
                            <button onclick="window.open('<?=$data['childData'][$i]['btn1url']?>')" class="layui-btn layui-btn-sm"><?=$data['childData'][$i]['btn1']?></button><?php
                                }else{?>
                            <button onclick="window.location.href='<?=$data['childData'][$i]['btn1url']?>'" class="layui-btn layui-btn-sm"><?=$data['childData'][$i]['btn1']?></button><?php
                                }
                            } 
                            if($data['childData'][$i]['btn2'] != null) {
                                if($data['childData'][$i]['btn2blank'] == 1){?>
                            <button onclick="window.open('<?=$data['childData'][$i]['btn2url']?>')" class="layui-btn layui-btn-primary layui-border-green layui-btn-sm"><?=$data['childData'][$i]['btn2']?></button><?php
                                }else{?>
                            <button onclick="window.location.href='<?=$data['childData'][$i]['btn2url']?>'" class="layui-btn layui-btn-primary layui-border-green layui-btn-sm"><?=$data['childData'][$i]['btn2']?></button><?php
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div><?php } ?>
                
            </div>
        </div>
    </div>
<?php
    View::view('/index/foot',$indexData);
?>