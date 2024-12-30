<?php
/**
 * Summary of AdminController
 * 后台首页 控制器
 * @author eogee.com
 */
namespace Controller;

class AdminController extends BasicController
{
    /**
     * Summary of index
     * 后台首页
     */
    public static function index()
    {
        self::limit();
        require_once 'Resource/view/admin/list.php';
    }
    
}
