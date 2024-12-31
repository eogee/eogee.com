<?php
namespace Helper;


/**
 * 处理url相关
 * @author eogee.com email:eogee@qq.com
 */
class Url {
    /**
     * Summary of getTable
     * 获取当前访问的表名
     * @param string $uri uri地址，默认为空
     * @return string|null 表名
     */
    public static function getTable($uri = null) 
    {
        if(empty($uri)){
            $uri = $_SERVER['REQUEST_URI'];
        }
        $uriArr = explode("/", $uri); #将获取到的uri进行拆分为数组
        if(!empty($uriArr[1]) and $uriArr[1] != 'index' and $uriArr[1] != 'admin'){
            return $uriArr[1];
        }else{
            return null;
        }
    }
    /**
     * Summary of getId
     * 获取当前访问的id
     * @param string $uri uri地址，默认为空
     * @return string|null id
     */
    public static function getId($uri = null)
    {
        if(empty($uri)){
            $uri = $_SERVER['REQUEST_URI'];
        }
        $uri = $_SERVER['REQUEST_URI'];
        $uriArr = explode("/", $uri);
        $num = count($uriArr);
        return $num > 3 ?  $uriArr[3] :  null;
    } 
}