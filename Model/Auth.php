<?php
/**
 * Summary of Auth
 * 后台登录验证类
 * @author eogee.com
 */
namespace Model;

use Model\Database;

class Auth
{    
    private static $tableName = 'user';#要操作的数据表名
    /**
     * Summary of login
     * 登录验证
     */
    public static function login()
    {
        $username = $_POST['username'];
        $username = filter_var($username, FILTER_SANITIZE_STRING);
        $password = $_POST['password'];
        $captcha = $_POST['captcha'];
        if(CONFIG['developer_mode'] == false){
            if(empty($username) || empty($password) || empty($captcha)) {
                Model::alert('请填写完整的登录信息！','back');
                die();
            }
            if($captcha != $_SESSION['captcha']){
                Model::alert('输入的验证码不正确，请重新输入！','back');
                die();
            }
        }
        $usernameExist = Database::select(self::$tableName,"where username = '$username'");
        if(count($usernameExist)> 0) {
            $result = Database::select(self::$tableName,"where username = '$username'");
            if( 
                /* $password == $result[0]["password"] */
                password_verify($password, $result[0]["password"])
            ) {
                $_SESSION["username"] = $username;#登录成功，设置session
                $_SESSION["csrf_token"] = Model::crsf();#生成csrf_token
                Model::redirect("/admin");
            }else{
                Model::alert('输入的密码不正确！','back');
            }
        }else{
            Model::alert('输入的用户名不存在！','back');
        }
    }
    /**
     * Summary of logout
     * 退出登录
     */
    public static function logout()
    {
        session_destroy();
        Model::alert('退出登录成功！','/auth/login');
    }
    /**
     * Summary of captcha
     * 生成验证码
     */
    public static function setCaptcha()
    {
        $str = "1234567890qwertyuiopasdfghjklzxcvbnm";
        $str = str_shuffle($str); #打乱顺序
        $content = substr($str, 0, 4); #截取前四位
        $_SESSION['captcha'] = $content;#将验证码存入session中
        $image = imagecreatetruecolor(105, 30); #创建图片
        $backgroud = imagecolorallocate($image, mt_rand(150, 255), mt_rand(150, 255), mt_rand(150, 255)); #定义背景颜色
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
            $color = imagecolorallocate($image, mt_rand(0, 100), mt_rand(0, 100), mt_rand(0, 100));
            $path = realpath('Resource/font/zhugulihei.ttf'); #转换为绝对路径
            imagefttext($image, 16, mt_rand(-15, 15), $x, 20, $color, $path, $char);
        }
        header("content-type:image/png");
        imagepng($image);
    }
}