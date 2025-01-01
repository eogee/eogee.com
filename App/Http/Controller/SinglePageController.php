<?php
namespace App\Http\Controller;


use Helper\Window;
use Model\Model;
/**
 * Summary of SinglePageController
 * 单页内容 控制器
 */
class SinglePageController extends BasicController
{    
    public static function listApi()
    {
        Model::listApi('','title,keynote,content');
    }
    public static function recycleApi()
    {
        Model::recycleApi('','title,keynote,content');
    }
    public static function support()
    {
        Window::redirect('/singlePage/detail/2');
    }
}
