<?php

namespace App\Http\Controller;

use Helper\View;
use Helper\Url;
use App\Model\Model;
use App\Model\News;

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
        $data = [
            'indexData' => $indexData,
            'data' => $data
        ];
        View::view('/index/'.Url::getTable(),$data);
    }
    public static function updateApi()
    {
        News::updateApi();
    }
    public static function edit()
    {
        self::limit();
        $id = Url::getId();
        if(isset($id)){
            View::view('/admin/'.Url::getTable().'/update');
        }else{
            Model::edit();
        }
    }
}
