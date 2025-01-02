<?php

namespace App\Http\Controller;

use Helper\View;
use Helper\Url;
use App\Model\Model;
use App\Model\News;
use App\Verify\Verify;
use App\Http\Response\Response;

/**
 * Summary of NewsController
 * 最新动态 控制器
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
        $data = News::updateApi();
        $response = new Response;
        $response->json($data);
    }
    public static function edit()
    {
        Verify::adminLimit();
        $id = Url::getId();
        if(isset($id)){
            View::view('/admin/'.Url::getTable().'/update');
        }else{
            Model::edit();
        }
    }
}
