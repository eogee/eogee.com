<?php

namespace App\Http\Controller;

use Easy\View\View;
use App\Model\News;

/**
 * Summary of IndexController
 * 前台首页 控制器
 * @author eogee.com
 */
class IndexController extends BasicController
{
    protected $news;
    public function __construct()
    {
        parent::__construct();
        $this->news = new News;
    }
    /**
     * Summary of index
     * 首页控制器，显示首页内容
     * 轮播图、产品中心、服务中心、课程中心、产品动态、课程动态、赞助商、友情链接
     */
    public function index()
    {
        $data = [
            'indexData' => $this->headData(),
            'content' => $this->model->showAll('contentParent','','sort','','content'),
            'carousel' => $this->model->showAll('carousel','','sort'),
            'news' => $this->news->showAll()
        ];

        View::view('/index/index',$data);
    }
    
}
