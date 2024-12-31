<?php
namespace App\Http\Controller;

use Model\Model;
use Model\News;
/**
 * Summary of IndexController
 * 前台首页 控制器
 * @author eogee.com
 */
class IndexController extends BasicController
{
    /**
     * Summary of index
     * 首页控制器，显示首页内容
     * 轮播图、产品中心、服务中心、课程中心、产品动态、课程动态、赞助商、友情链接
     */
    public static function index()
    {
        $indexData = self::headData();
        $content = Model::showAll('contentParent','','sort','','content');
        $carousel = Model::showAll('carousel','','sort');
        $news = News::showAll();
        
        echo $rootPath = $_SERVER['DOCUMENT_ROOT']; // 网站的根目录

        echo $rootPath = realpath(dirname(__DIR__)); // 获取项目根目录的绝对路径

        //require_once '/../../Public/view/index/index.php';
    }
    
}
