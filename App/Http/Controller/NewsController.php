<?php
namespace Controller;

use Model\Model;
use Model\News;
/**
 * Summary of NewsController
 * 最新动态 控制器
 * @author eogee.com
 */
class NewsController extends BasicController
{
    public static function index()
    {
        $indexData = self::headData();
        $data = News::showAll();
        require_once 'Resource/view/index/news.php';
    }
    public static function updateApi()
    {
        News::updateApi();
    }
    public static function edit()
    {
        self::limit();
        $id = News::getId();
        if(isset($id)){
            require_once 'Resource/view/admin/'.News::getTable().'/update.php';
        }else{
            Model::edit();
        }
    }
}
