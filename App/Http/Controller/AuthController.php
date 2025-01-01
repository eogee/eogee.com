<?php

namespace App\Http\Controller;

use Helper\Auth;
use Helper\View;

/**
 * Summary of AuthController
 * 用户验证控制器
 * @author <eogee.com> <<eogee@qq.com>>
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
            View::view('/admin/auth/login');
        }
    }
    /**
     * Summary of captcha
     * 生成验证码
     * @return void
     */
    public static function setCaptcha(){
        Auth::setCaptcha();
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


