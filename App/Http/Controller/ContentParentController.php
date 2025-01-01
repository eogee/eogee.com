<?php

namespace App\Http\Controller;

use Model\Model;

/**
 * Summary of ContentParentController
 * 内容中心 控制器
 */
class ContentParentController extends BasicController
{
    
    public static function listApi()
    {
        Model::listApi('','title,keynote');
    }
    public static function recycleApi()
    {
        Model::recycleApi('','title,keynote');
    }
}
