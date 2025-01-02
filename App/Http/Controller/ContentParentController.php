<?php

namespace App\Http\Controller;

use App\Model\Model;
use App\Http\Response\Response;

/**
 * Summary of ContentParentController
 * 内容中心 控制器
 */
class ContentParentController extends BasicController
{
    
    public static function listApi()
    {
        $data = Model::listApi('','title,keynote');
        $response = new Response;
        $response->json($data);
    }
    public static function recycleApi()
    {
        $data = Model::recycleApi('','title,keynote');
        $response = new Response;
        $response->json($data);
    }
}
