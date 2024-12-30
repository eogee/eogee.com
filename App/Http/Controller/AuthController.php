<?php
namespace Controller;

use Model\Auth;
/**
 * Summary of AuthController
 * 用户验证控制器
 * @author eogee.com
 */
class AuthController{
    /**
     * Summary of login
     * 登录验证
     * @return void
     */
    public static function login()
    {
        if(isset($_POST["username"])){
            Auth::login();
        }else{            
            require_once 'Resource/view/admin/auth/login.php';
        }
    }
    /**
     * Summary of captcha
     * 验证码
     * @return void
     */
    public static function captcha(){
        Auth::captcha();
    }
    /**
     * Summary of logout
     * 注销登录
     * @return void
     */
    public static function logout()
    {
        Auth::logout();
    }
}


