<?php

namespace App\Http\Controller;

use Helper\View;

/**
 * Summary of AdminController
 * 后台首页 控制器
 * @author <eogee.com> <<eogee@qq.com>>
 */
class AdminController extends BasicController
{
    /**
     * Summary of index
     * 后台首页
     */
    public static function index()
    {
        self::limit();
        View::view('/admin/list');
    }
    
}
