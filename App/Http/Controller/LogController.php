<?php

namespace App\Http\Controller;

use App\Model\Model;

/**
 * Summary of LogController
 * 访问日志 控制器
 */
class LogController extends BasicController
{
    public static function listApi()
    {
        Model::listApi('log','ip,address,referrer');
    }
}
