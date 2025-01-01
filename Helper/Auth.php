<?php
/**
 * Summary of Auth
 * 后台登录验证类
 * @author <eogee.com> <<eogee@qq.com>>
 */
namespace Helper;

use Helper\Session;
use Helper\Window;
use Helper\Database;
use Helper\Password;
use App\Http\Request\Request;

class Auth
{    
    private static $tableName = CONFIG['database']['user_table'];#要操作的数据表名
    /**
     * Summary of login
     * 登录验证
     * @return void
     */
    public static function login()
    {
        $username = $_POST['username'];
        $username = filter_var($username, FILTER_SANITIZE_STRING);
        $password = $_POST['password'];
        if(empty($username) || empty($password)) {
            Window::alert('请填写完整的登录信息！','back');
            die();
        }

        self::checkCaptcha();

        $usernameExist = Database::select(self::$tableName,"where username = '$username'");
        if(count($usernameExist)> 0) {
            $result = Database::select(self::$tableName,"where username = '$username'");
            if(/* $password == $result[0]["password"] */Password::verify($password, $result[0]["password"])
            ){
                Session::set('username', $username);
                Session::set('csrf_token', Request::crsf());
                Window::redirect("/admin");
            }else{
                Window::alert('输入的用户名或密码不正确！','back');
            }
        }else{
            Window::alert('输入的用户名或密码不正确！','back');
        }
    }
    /**
     * Summary of logout
     * 退出登录
     * @return void
     */
    public static function logout()
    {
        Session::destroy();
        Window::alert('退出登录成功！','/auth/login');
    }
    /**
     * Summary of setCaptcha
     * 生成验证码
     * @return void
     */
    public static function setCaptcha()
    {
        $str = "1234567890qwertyuiopasdfghjklzxcvbnm";
        $str = str_shuffle($str); #打乱顺序
        $content = substr($str, 0, 4); #截取前四位

        Session::set('captcha', $content); #将验证码存入session中

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
            $path = Path::rootPath().'/public/font/zhugulihei.ttf';#字体绝对路径
            imagefttext($image, 16, mt_rand(-15, 15), $x, 20, $color, $path, $char);
        }
        header("content-type:image/png");
        imagepng($image);
    }
    /**
     * Summary of checkCaptcha
     * 验证码验证
     * @return void
     */
    public static function checkCaptcha()
    {
        if(CONFIG['app']['developer_mode'] == false){
            if(empty($_POST['captcha']) || empty($_SESSION['captcha']) || $_POST['captcha'] !== $_SESSION['captcha']){
                Window::alert('输入的验证码不正确，请重新输入！','back');
                die();
            }
        }
    }
}