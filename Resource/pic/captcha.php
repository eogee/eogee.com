<?php
/* 随机生产验证码图片 */

$str = "1234567890qwertyuiopasdfghjklzxcvbnm";
$str = str_shuffle($str); #打乱顺序
$content = substr($str, 0, 4); #截取前四位
$image = imagecreatetruecolor(105, 30); #创建图片
$backgroud = imagecolorallocate($image, mt_rand(100, 255), mt_rand(100, 255), mt_rand(100, 255)); #定义背景颜色
imagefill($image, 0, 0, $backgroud); #给图片填充背景
for ($i = 0; $i < 100; $i++) {
    #加入点干扰元素
    $color = imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(100, 255));
    imagesetpixel($image, mt_rand(0, 105), mt_rand(0, 30), $color);
}
for ($i = 0; $i < 3; $i++) {
    #加入线干扰元素
    $color = imagecolorallocate($image, mt_rand(100, 255), mt_rand(0, 255), mt_rand(0, 255));
    imageline($image, 0, mt_rand(0, 30), 105, mt_rand(0, 30), $color);
}
for ($i = 0; $i < strlen($content); $i++) {
    #向图片写入内容
    $char = $content[$i];
    $x = 15 + 20 * $i;
    $color = imagecolorallocate($image, mt_rand(0, 155), mt_rand(0, 155), mt_rand(0, 155));
    $path = realpath('Resource/font/zhugulihei.ttf'); #转换为绝对路径
    imagefttext($image, 16, mt_rand(-15, 15), $x, 20, $color, $path, $char);
}
header("content-type:image/png");
imagepng($image);
