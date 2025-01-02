<?php

namespace App\Verify;

use Helper\Window;

/**
 * Summary of Verify
 * 验证类
 * @author <eogee.com> <<eogee@qq.com>>
 */
class Verify{
    /**
     * 后台访问限制
     * @return void
     */
    public static function adminLimit()
    {
        if(!isset($_SESSION['username'])){
            Window::redirect('/auth/login');//判断是否登录
            die();
        }
    }
    /**
     * CSRF 攻击验证
     */
    public static function crsfVerify()
    {
        if(empty($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf_token']) {
            die('CSRF attack detected!');
        }else{
            unset($_POST['csrf']);
        }
    }
}
