<?php
namespace Helper;

use Helper\Path;

/**
 * 视图操作
 * @author eogee.com email:eogee@qq.com
 */
class View
{
    /**
     * Summary of view
     * 视图渲染
     * @param mixed $view  视图文件路径
     * @param mixed $data  视图数据
     * @return void 引入一个视图文件并渲染
     */
    public static function view($view, $data = [])
    {

        require_once Path::rootPath(). '/Public/view'. $view. '.php';

    }
}