<?php
namespace Helper;
/**
 * Summary of Window
 * 窗口操作类
 * @author <eogee> <<eogee@qq.com>>
 */
class Window {
    /**
     * 弹出提示框
     * @param string $message 提示信息
     * @param string $url 跳转地址，默认为空，不跳转
     */
    public static function alert($message,$url = null) 
    {
        if(empty($url)){
            echo "<script>alert('$message');</script>";
        }else if($url == 'back'){
            echo "<script>alert('$message');window.history.go(-1);</script>";
        }else{
            echo "<script>alert('$message');window.location.href='$url';</script>";
        }        
    }
    /**
     * 重定向到指定页面
     * @url string 要跳转的页面地址
     */
    public static function redirect($url) 
    {
        header("Location: $url");
        exit();
    }
    /**
     * 获取请求头部信息
     * @return array 请求头部信息
     */
    public static function getHeader() 
    {
        return headers_list();
    }
    /**
     * 设置头部信息
     * @param string $header 请求头部信息
     */
    public static function setHeader($header) 
    {
        header($header);
    }
}