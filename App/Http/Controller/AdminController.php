<?php

namespace App\Http\Controller;

use Easy\View\View;

/**
 * Summary of AdminController
 * 后台首页 控制器
 */
class AdminController extends Controller
{
    /**
     * Summary of index
     * 后台首页
     */
    public function index()
    {
        $this->verify->adminLimit();
        View::view('/admin/list');
    }
}
