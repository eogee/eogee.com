<?php

namespace Easy\Route;

/**
 * Class Route
 * 操作路由类
 * @package Easy\Route
 */
class Route
{
    private static $instance; // 单例实例
    protected static $routes = []; // 存储路由配置

    // 构造函数私有化，防止外部实例化
    private function __construct()
    {
    }

    /**
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
     * 定义单个get路由
     * @param string $uri 路由 URI
     * @param string $controller 控制器名称
     * @param string $action 方法名称
     * @return Route
     */
    public function set($uri, $controller, $action)
    {
        self::$routes[$uri] = [
            $controller
            ,$action
            ,'middleware' => null // 默认没有中间件
        ];
        return $this; // 支持链式调用
    }
    
    /**
     * 添加中间件
     * @param string $uri 路由 URI
     * @param string $middleware 中间件名称
     * @return Route
     * @throws \Exception
     */
    public function middleware($uri, $middleware)
    {        
        // 将中间件添加到指定路由
        self::$routes[$uri]['middleware'] = $middleware;
        return $this; // 支持链式调用
    }

    
    /**
     * 应用中间件逻辑
     * @param string $middleware
     * @return void
     * @throws \Exception
     */
    protected static function applyMiddleware($middleware,$request,$next)
    {
        // 获取中间件类
        $middlewareClass = CONFIG['middleware'][$middleware][0] ?? null;

        if ($middlewareClass && class_exists($middlewareClass)) {
            $middlewareInstance = new $middlewareClass();
            if (method_exists($middlewareInstance, 'handle')) {
                $middlewareInstance->handle($request, $next); // 调用中间件的 handle 方法
            } else {
                throw new \Exception("Middleware does not have handle method: " . $middleware);
            }
        } else {
            throw new \Exception("Middleware not found: " . $middleware);
        }
    }

    /**
     * 路由解析
     * @param string $uri
     * @return mixed
     * @throws \Exception
     */
    public static function index($uri)
    {
        if(strpos($uri,'?')){
            $uri = substr($uri,0,strpos($uri,'?'));
        }//获取当前请求的uri，去除get参数

        $uriArr = explode("/", $uri);//分割uri
        $num = count($uriArr);//获取uri的数量$
        $num > 3 ? $uri = "/".$uriArr[1]."/".$uriArr[2] : null;

        $route = self::$routes[$uri];
        $controllerName = $route[0];
        $actionName = $route[1];

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

        // 定义下一个中间件或控制器方法
        $next = function ($request) use ($controller, $actionName) {
            return $controller->$actionName($request);
        };

        $request = [];

        // 处理中间件
        if (!empty($route['middleware'])) {
            return self::applyMiddleware($route['middleware'],[], $next);
        }
        return $next([]);
    }
}
