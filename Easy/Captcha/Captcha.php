<?php

namespace Easy\Captcha;

use Easy\Session\Session;
use Helper\Window;
use Helper\Path;

/**
 * Summary of Captcha
 * 验证码操作类
 * @author Eogee
 * @email eogee@qq.com 
 */
class Captcha
{
    protected $session;
    protected $captchaEnable; //是否开启图形验证码
    protected $captchaFont; //图形验证码字体
    protected $captchaFontSize; //图形验证码字号

    public function __construct(Session $session ,array $config)
    {
        $this->session = new Session;

        // 验证码配置
        $this->captchaEnable = $config['app']['captcha_enable'];
        $this->captchaFont = $config['app']['captcha_font']; 
        $this->captchaFontSize = $config['app']['captcha_font_size'];
    }
    /**
     * Summary of setCaptcha
     * 生成图形验证码
     * @return void
     */
    public function setCaptcha()
    {
        //生成图形验证码
        $str = "1234567890qwertyuiopasdfghjklzxcvbnm";
        $str = str_shuffle($str); //打乱顺序
        $content = substr($str, 0, 4); //截取前四位

        //图形验证码存入session
        $this->session->set('captcha', $content); //将图形验证码存入session中

        //生成验证码图片
        $image = imagecreatetruecolor(105, 30); //创建图片
        $backgroud = imagecolorallocate($image, mt_rand(150, 255), mt_rand(150, 255), mt_rand(150, 255)); //定义背景颜色
        imagefill($image, 0, 0, $backgroud); //给图片填充背景
        for ($i = 0; $i < 100; $i++) {
            //加入点干扰元素
            $color = imagecolorallocate($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(100, 255));
            imagesetpixel($image, mt_rand(0, 105), mt_rand(0, 30), $color);
        }
        for ($i = 0; $i < 3; $i++) {
            //加入线干扰元素
            $color = imagecolorallocate($image, mt_rand(100, 255), mt_rand(0, 255), mt_rand(0, 255));
            imageline($image, 0, mt_rand(0, 30), 105, mt_rand(0, 30), $color);
        }
        for ($i = 0; $i < strlen($content); $i++) {
            //向图片写入内容
            $char = $content[$i];
            $x = 15 + 20 * $i;
            $color = imagecolorallocate($image, mt_rand(0, 100), mt_rand(0, 100), mt_rand(0, 100));
            $path = Path::rootPath().'/public/font/'.$this->captchaFont;#字体绝对路径
            imagefttext($image, $this->captchaFontSize, mt_rand(-15, 15), $x, 20, $color, $path, $char);
        }

        //输出验证码图片
        header("content-type:image/png");
        imagepng($image);
        imagedestroy($image); // 释放图像资源
    }
    /**
     * Summary of checkCaptcha
     * 图形验证码验证
     * @return void
     */
    public function checkCaptcha($captcha)
    {
        if($this->captchaEnable){
            if(empty($captcha) || empty($_SESSION['captcha']) || $captcha !== $_SESSION['captcha']){
                Window::alert('输入的验证码不正确，请重新输入！','back');
                die();
            }

            //图形验证码验证成功，删除session中的图形验证码
            $this->session->delete('captcha'); 
        }
    }

}