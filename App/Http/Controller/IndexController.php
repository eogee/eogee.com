<?php

namespace App\Http\Controller;

use Helper\View;
use App\Model\Model;
use App\Model\News;

/**
 * Summary of IndexController
 * 前台首页 控制器
 * @author eogee.com
 */
class IndexController extends BasicController
{
    /**
     * Summary of index
     * 首页控制器，显示首页内容
     * 轮播图、产品中心、服务中心、课程中心、产品动态、课程动态、赞助商、友情链接
     */
    public static function index()
    {        
        $data = [
            'indexData' => self::headData(),
            'content' => Model::showAll('contentParent','','sort','','content'),
            'carousel' => Model::showAll('carousel','','sort'),
            'news' => News::showAll()
        ];

        View::view('/index/index',$data);
    }
    
}