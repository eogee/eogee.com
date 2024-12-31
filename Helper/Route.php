<?php
namespace Helper;
/**
 * Summary of Route
 * 操作路由类
 * @author eogee.com
 * @version 1.0.0
 * @bugContacts: You can contact us by email:eogee@qq.com or QQ: 3886370035
 * @联系我们: 邮箱:eogee@qq.com 或 QQ: 3886370035
 */
class Route
{
    private static $instance;#定义一个私有的静态属性 用于保存本类的实例
    protected static $routes = [];
    /**
     * Summary of __construct
     * 构造函数私有化
     */
    private function __construct()#构造函数私有化
    {

    }
    /**
     * Summary of getInstance
     * 获取本类的实例
     * @return Route
     */
    public static function getInstance()
    {
        if(!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }
    /**
     * Summary of define
     * define路由
     * @param mixed $routes
     * @return void
     */
    public static function define($routes)
    {
       self::$routes = $routes;//保存路由配置
    }
    /**
     * Summary of index
     * 路由解析
     * @param mixed $uri
     * @return void
     */
    public static function index($uri)
    {
        $uriArr = [];
        $uriArr = explode("/", $uri);//分割uri
        $num = count($uriArr);//获取uri的数量
        $num > 3 ? $uri = "/".$uriArr[1]."/".$uriArr[2] : null;//判断uri的数量是否大于3，如果大于3，则将前两位作为控制器和方法名
        $arr = self::$routes[$uri];//获取路由配置
        $actionName = $arr[1];//获取方法名
        $nameSpace = "App\Http\Controller\\".$arr[0];//"\\"防止转义
        $nameSpace::$actionName();//调用控制器方法
    }
}