<?php

namespace App\Http\Controller;

use App\Verify\Verify;
use Helper\Window;
use Easy\Auth\Auth;
use Easy\View\View;
use Easy\Captcha\Captcha;
use Easy\Session\Session;

/**
 * Summary of AuthController
 * 用户验证控制器
 * @author Eogee
 * @email eogee@qq.com 
 */
class AuthController{
    protected $captcha;
    protected $auth;
    protected $verify;
    public function __construct()
    {
        $session = new Session(CONFIG);
        $this->captcha = new Captcha($session, CONFIG);
        
        $this->auth = new Auth(CONFIG);
        $this->verify = new Verify;
    }
    /**
     * Summary of login
     * 登录验证
     * @return void
     */
    public function login()
    {
        if(isset($_POST["username"])){
            if (!$this->verify->validate($_POST)) {
                Window::alert('请填写完整且符合格式的登录信息！', 'back');
                die();
            }else{
                if($this->auth->login()){
                    Window::redirect('/admin');
                }
            }
        }else{
            View::view('/admin/auth/login');
        }
    }
    /**
     * Summary of captcha
     * 生成图形验证码
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


