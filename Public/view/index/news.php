<?php
    $indexData = $data['indexData'];
    use Helper\View;
    View::view('/index/head', $indexData);
    $data = $data['data'];
?> 
    
    <div class="eog-container">
        <div class = "eog-image-background-half  eog-index-main" style = "background-image:url('<?=$data['info']['data']['backgroundImage']?>')">
            <div class="layui-container  eog-text">
                <h1 class = "<?= $data['info']['data']['top'] ? 'padding-top-60' : null ?> layui-font-<?=$data['info']['data']['titleColor']?> eog-text-shadow-<?=$data['info']['data']['titleShadowColor']?>"><?=$data['info']['data']['title']?></h1>
                <h3 class = "layui-font-<?=$data['info']['data']['keynoteColor']?> eog-text-shadow-<?=$data['info']['data']['keynoteShadowColor']?>"><?=$data['info']['data']['keynote']?></h3>
            </div>
        </div>
        <div class="layui-container eog-text">
            <div class="layui-row layui-col-space15"><?php
                $dataNum = count($data['data']) > 4 ? 4 : count($data['data']);
                $mdNum = 12/$dataNum;
                for ($i = 0; $i < $dataNum ; $i++) { ?>

                <div class="layui-col-md<?=$mdNum?>">
                    <fieldset class="layui-elem-field">
                        <legend>
                            <h4><?=$data['data'][$i]['title']?>最新动态</h4>
                        </legend>
                        <div class="layui-field-box">
                            <div class="layui-timeline"><?php                            
                                foreach ($data['data'][$i]['childData'] as $key => $value) { ?>

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
    </div>
<?php
    View::view('/index/foot',$indexData);
?>