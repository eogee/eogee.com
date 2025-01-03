<?php

namespace Easy\Route;

/**
 * Summary of Route
 * 操作路由类
 * @author <eogee.com> <<eogee@qq.com>>
 */
class Route
{
    private static $instance; // 定义一个私有的静态属性，用于保存本类的实例
    protected static $routes = [];

    /**
     * Summary of __construct
     * 构造函数私有化
     */
    private function __construct()
    {
        // 构造函数私有化，防止外部实例化
    }

    /**
     * Summary of getInstance
     * 获取本类的实例
     * @return Route
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Summary of define
     * 定义路由
     * @param mixed $routes 路由配置
     * @return void
     */
    public static function define($routes)
    {
        self::$routes = $routes; // 保存路由配置
    }

    /**
     * Summary of index
     * 路由解析
     * @param mixed $uri
     * @return void
     */
    public static function index($uri)
    {
        $uriArr = explode("/", $uri); // 分割 URI
        $num = count($uriArr); // 获取 URI 的数量

        // 判断 URI 的数量是否大于 3，如果大于 3，则将前两位作为控制器和方法名
        $uri = ($num > 3) ? "/" . $uriArr[1] . "/" . $uriArr[2] : $uri;

        // 获取路由配置
        if (!isset(self::$routes[$uri])) {
            throw new \Exception("Route not found: " . $uri);
        }

        $arr = self::$routes[$uri]; // 获取路由配置
        $controllerName = $arr[0]; // 获取控制器名
        $actionName = $arr[1]; // 获取方法名

        // 构造完整的控制器类名
        $nameSpace = "App\Http\Controller\\" . $controllerName;

        // 检查控制器类是否存在
        if (!class_exists($nameSpace)) {
            throw new \Exception("Controller not found: " . $nameSpace);
        }

        // 实例化控制器
        $controller = new $nameSpace();

        // 检查方法是否存在
        if (!method_exists($controller, $actionName)) {
            throw new \Exception("Action not found: " . $actionName);
        }

        // 调用方法
        $controller->$actionName();
    }
}
