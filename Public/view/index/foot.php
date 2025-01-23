<?php
$indexData = $data;
?>

    <div class="layui-footer eog-footer">
        <p>
            <?php
            if( $indexData['copyright'] !== null){
            echo 'Copyright &copy; '.$indexData['copyright'];}
            if( $indexData['siteName'] !== null){ ?>

            <a href="<?= $indexData['indexUrl']?>"><?= $indexData['siteName'] ?></a><?php }
            if( $indexData['recordCode'] !== null){ ?>

            <a href="https://beian.miit.gov.cn"  target="_blank"><?= $indexData['recordCode'] ?></a><?php } ?>
        
        </p>
        <p id="footerInfo"><?php
            $internal = $indexData['internal'];
            for($i = 0; $i < count($internal); $i++){ 
                if($internal[$i]['blank'] == 1){?>
            <a href="<?= $internal[$i]['url'] ?>" <?=$internal[$i]['blank'] == 1 ? 'target="_blank" ': ''?>><?= $internal[$i]['name'] ?></a> <?php } else {?>

            <a href="<?= $internal[$i]['url'] ?>"><?= $internal[$i]['name'] ?></a> <?php } } ?>

        </p>
        <p>
            鸣谢：<?php
                $sponsor = $indexData['sponsor'];
                for ($i = 0; $i < count($sponsor); $i++) { ?>

            <a href="<?= $sponsor[$i]['url'] ?>" <?=$sponsor[$i]['blank'] == 1 ? 'target="_blank" ': ''?> sponsor="<?= $sponsor[$i]['name'] ?>" style="color: <?= $sponsor[$i]['colorCode'] ?>;"><?= $sponsor[$i]['name'] ?></a><?php } ?>

        </p>
        <p>
            友情链接：<?php
                    $friendUrl = $indexData['friendUrl'];
                    for ($i = 0; $i < count($friendUrl); $i++) { ?>

            <a href="<?= $friendUrl[$i]['url'] ?>" <?=$friendUrl[$i]['blank'] == 1 ? 'target="_blank" ': ''?>><?= $friendUrl[$i]['name'] ?></a><?php } ?>

        </p>
    </div>
    <div id="shade" class="eog-shade"></div>
    <script>
        // 移动端菜单栏
        mobileNav();

        // 移动端导航树
        mobileNavTree();

        // 移动端显示简称
        mobileAbbreName();

        // 侧边栏
        monbileSideNav();

        // 右下角固定条
        bars();
    </script>
</body>
</html>