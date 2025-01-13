<?php

namespace Easy\Captcha;

use Easy\Session\Session;
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
        //获取session实例
        $this->session = $session;

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
     * Summary of setEmailCaptcha
     * 生成邮箱验证码
     * @return string
     */
    public function setEmailCaptcha()
    {
        //生成验证码
        $str = "1234567890";
        $str = str_shuffle($str); //打乱顺序
        $content = substr($str, 0, 6); //截取前六位

        //验证码存入session
        $this->session->set('email_captcha', $content); //将验证码存入session中
        
        return $content;
    }
    /**
     * Summary of checkCaptcha
     * 图形验证码验证
     * @return bool;
     */
    public function checkCaptcha($captcha)
    {
        if($this->captchaEnable){
            if(empty($captcha) || empty($_SESSION['captcha']) || $captcha !== $_SESSION['captcha']){
                return false;
            }
        }
        return true;
    }

    /**
     * Summary of checkEmailCaptcha
     * 邮箱验证码验证
     * @return bool;
     */
    public function checkEmailCaptcha($captcha)
    {
        if($this->captchaEnable){
            if(empty($captcha) || empty($_SESSION['email_captcha']) || $captcha !== $_SESSION['email_captcha']){
                return false;
            }
        }
        return true;
    }

}