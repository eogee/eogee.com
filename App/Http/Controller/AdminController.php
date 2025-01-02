<?php

namespace App\Http\Controller;

use Helper\View;
use App\Verify\Verify;

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
    public static function index()
    {
        Verify::adminLimit();
        View::view('/admin/list');
    }
    
}
