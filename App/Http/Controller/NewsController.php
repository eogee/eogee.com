<?php
namespace App\Http\Controller;


use Helper\View;
use Helper\Url;
use Model\Model;
use Model\News;
/**
 * Summary of NewsController
 * 最新动态 控制器
 * @author eogee.com
 */
class NewsController extends BasicController
{
    public static function index()
    {
        $indexData = self::headData();
        $data = News::showAll();
        $data = [
            'indexData' => $indexData,
            'data' => $data
        ];
        View::view('/index/'.Url::getTable(),$data);
    }
    public static function updateApi()
    {
        News::updateApi();
    }
    public static function edit()
    {
        self::limit();
        $id = News::getId();
        if(isset($id)){
            require_once 'Resource/view/admin/'.News::getTable().'/update.php';
        }else{
            Model::edit();
        }
    }
}
