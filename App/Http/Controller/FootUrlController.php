<?php

namespace App\Http\Controller;

use App\Model\Model;
use App\Http\Response\Response;

/**
 * Summary of FootUrlController
 * 底部链接 控制器
 */
class FootUrlController extends BasicController
{
    
    public static function listApi()
    {
        $data = Model::listApi('','name');
        $response = new Response;
        $response->json($data);
    }
    public static function recycleApi()
    {
        $data = Model::recycleApi('','name');
        $response = new Response;
        $response->json($data);
    }
}
