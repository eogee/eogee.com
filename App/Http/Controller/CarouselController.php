<?php

namespace App\Http\Controller;

use App\Model\Model;
use App\Http\Response\Response;

/**
 * Summary of CarouselController
 * 轮播图 控制器
 */
class CarouselController extends BasicController
{
    
    public static function listApi()
    {
        $data = Model::listApi('','title,keynote,content');
        $response = new Response;
        $response->json($data);
    }
    public static function recycleApi()
    {
        $data = Model::recycleApi('','title,keynote,content');
        $response = new Response;
        $response->json($data);
    }
}
