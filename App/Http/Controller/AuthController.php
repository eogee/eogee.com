<?php

namespace App\Http\Controller;

use Easy\Auth\Auth;
use Easy\View\View;
use Easy\Captcha\Captcha;

/**
 * Summary of AuthController
 * 用户验证控制器
 * @author <eogee.com> <<eogee@qq.com>>
 */
class AuthController{
    protected $captcha;
    protected $auth;
    public function __construct()
    {
        $this->captcha = new Captcha;
        $this->auth = new Auth;
    }
    /**
     * Summary of login
     * 登录验证
     * @return void
     */
    public function login()
    {
        if(isset($_POST["username"])){
            $this->auth->login();
        }else{
            View::view('/admin/auth/login');
        }
    }
    /**
     * Summary of captcha
     * 生成验证码
     * @return void
     */
    public function setCaptcha(){
        $this->captcha->setCaptcha();
    }
    /**
     * Summary of logout
     * 注销登录
     * @return void
     */
    public function logout()
    {
        $this->auth->logout();
    }
}


