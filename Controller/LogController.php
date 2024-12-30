<?php
namespace Controller;
use Model\Model;
/**
 * Summary of LogController
 * 访问日志 控制器
 * @author eogee.com
 */
class LogController extends BasicController
{
    public static function listApi()
    {
        Model::listApi('log','ip,address,referrer');
    }
}
