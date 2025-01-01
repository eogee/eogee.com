<?php

namespace Helper;

use Helper\Database;

/**
 * 处理Session相关
 * @author <eogee.com> <<eogee@qq.com>>
 */
class Session
{
    /**
     * Summary of start
     * 开启session
     * @return void
     */
    public static function start()
    {
        session_start();
    }
    /**
     * Summary of set
     * 设置session
     * @param mixed $key
     * @param mixed $value
     * @return void
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    /**
     * Summary of get
     * 获取session
     * @param mixed $key
     * @return mixed
     */
    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return null;
        }
    }
    /**
     * Summary of delete
     * 删除session
     * @param mixed $key
     * @return void
     */
    public static function delete($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }
    /**
     * Summary of getUser
     * 获取当前登录的用户
     * @return mixed | null 返回当前登录的用户名
     */
    public static function getUser()
    {
        if (isset($_SESSION['username'])) 
        {
            return $_SESSION['username'];
        }
        else
        {
            return null;
        }
    }
    /**
     * Summary of getUserId
     * 获取当前登录的用户id
     * @return mixed | null 返回当前登录的用户id
     */
    public static function getUserId()
    {
        if(!empty(self::getUser()))
        {
            Database::select('user',"where username = '".self::getUser()."'")[0]['id'];
        }else{
            return null;
        }
    }
    /**
     * Summary of destroy
     * 销毁session
     * @return void
     */
    public static function destroy()
    {
        session_destroy();
    }
}