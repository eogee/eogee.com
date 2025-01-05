<?php

namespace Easy\Verify;

use Helper\Window;

class LimitVerify {
    public function verify()
    {
        if(!isset($_SESSION['username'])){
            Window::redirect('/auth/login');//判断是否登录
            die();
        }
    }
}