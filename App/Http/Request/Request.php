<?php

namespace App\Http\Request;

use Helper\Window;

/**
 * Summary of Request
 * 请求类
 * @author <eogee.com> <<eogee@qq.com>>
 */
class Request
{
    /**
     * Summary of crsf
     * 生成csrf
     * @return string
     */
    public static function crsf()
    {
        return bin2hex(random_bytes(32));        
    }
    /**
     * Summary of adminLimit
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
}