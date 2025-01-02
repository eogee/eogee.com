<?php

namespace App\Http\Controller;

use App\Model\Model;
use App\Http\Response\Response;

/**
 * Summary of LogController
 * 访问日志 控制器
 */
class LogController extends BasicController
{
    public static function listApi()
    {
        $data = Model::listApi('log','ip,address,referrer');
        $response = new Response;
        $response->json($data);
    }
}
