<?php

namespace App\Http\Controller;

use Helper\Window;
use App\Model\Model;
use App\Http\Response\Response;

/**
 * Summary of SinglePageController
 * 单页内容 控制器
 */
class SinglePageController extends BasicController
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
    public static function support()
    {
        Window::redirect('/singlePage/detail/2');
    }
}
