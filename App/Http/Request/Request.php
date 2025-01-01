<?php
namespace App\Http\Request;
/**
 * Summary of Request
 * 请求类
 * @author <eogee.com> <<eogee@qq.com>>
 */

class Request
{
    /**
     * Summary of crsf
     * 生成csrf
     * @return string
     */
    public static function crsf()
    {
        return bin2hex(random_bytes(32));        
    }
}