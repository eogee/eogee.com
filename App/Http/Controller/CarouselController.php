<?php
namespace Controller;

use Model\Model;
/**
 * Summary of CarouselController
 * 轮播图 控制器
 */
class CarouselController extends BasicController
{
    
    public static function listApi()
    {
        Model::listApi('','title,keynote,content');
    }
    public static function recycleApi()
    {
        Model::recycleApi('','title,keynote,content');
    }
}
