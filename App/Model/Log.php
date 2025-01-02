<?php
namespace App\Model;

use Helper\Database;
use Helper\Session;

/**
 * 日志 模型
 */
class Log extends Model 
{
    private static  $table = "log";
    /**
     * Summary of insert
     * log表新增一条数据
     */
    public static function insert()
    {
        $data['ip'] = $_SERVER['REMOTE_ADDR'];//IP地址        
        if($data['ip'] !== CONFIG['test_env_ip'] and $data['ip'] !== '127.0.0.1'){//测试环境不记录日志
            if(isset($_SESSION['username']) and $_SESSION['username']!= null){
                $data['username'] = $_SESSION['username'];//用户名
                $data['userId'] = Session::getUserId();//用户ID
            }
            $data['address'] = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];//访问地址            
            $data['userAgent '] = $_SERVER['HTTP_USER_AGENT'];//浏览器类型            
            $data['statusCode '] = http_response_code();//状态码
            if (isset($_SERVER['HTTP_REFERER'])) {
                $data['referrer '] = $_SERVER['HTTP_REFERER'];//来源地址
            } else {
                $data['referrer '] = null;
            }
            $data['requestMethod '] = $_SERVER['REQUEST_METHOD'];//请求方式            
            Database::insert(self::$table,$data);//插入数据
        }
    }
}
