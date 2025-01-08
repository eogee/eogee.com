<?php

namespace App\Http\Controller;

use Easy\View\View;

/**
 * Summary of AdminController
 * 后台首页 控制器
 */
class AdminController extends BasicController
{
    /**
     * Summary of index
     * 后台首页
     */
    public function index()
    {
        $this->limitVerify->verify();
        View::view('/admin/list');
    }
}
