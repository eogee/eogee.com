<?php

namespace App\Http\Controller;

use Model\Model;

/**
 * Summary of FootUrlController
 * 底部链接 控制器
 */
class FootUrlController extends BasicController
{
    
    public static function listApi()
    {
        Model::listApi('','name');
    }
    public static function recycleApi()
    {
        Model::recycleApi('','name');
    }
}
