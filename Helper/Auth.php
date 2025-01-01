<?php

namespace Helper;

use Helper\Session;
use Helper\Window;
use Helper\Database;
use Helper\Password;
use Helper\Captcha;
use App\Http\Request\Request;

/**
 * Summary of Auth
 * 后台登录验证类
 * @author <eogee.com> <<eogee@qq.com>>
 */
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

        Captcha::checkCaptcha();

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
}