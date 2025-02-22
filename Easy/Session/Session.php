<?php

namespace Easy\Session;

use Easy\Database\Database;

/**
 * 处理Session相关
 * @author Eogee
 * @email eogee@qq.com 
 */
class Session
{
    protected $db;

    protected $userTableName;

    protected $userCol;

    public function __construct($config)
    {
        // 获取数据库实例
        $this->db = Database::getInstance($config);

        // 设置默认的user表名和user列名
        $this->userTableName = $config['database']['user_table'];
        $this->userCol = $config['database']['user_col'];
    }
    /**
     * Summary of start
     * 开启session
     * @return void
     */
    public function start()
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
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    /**
     * Summary of get
     * 获取session
     * @param mixed $key
     * @return mixed
     */
    public function get($key)
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
    public function delete($key)
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
    public function getUser()
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
    public function getUserId()
    {
        if(!empty(self::getUser()))
        {
            return $this->db->select($this->userTableName,"where ".$this->userCol." = '".self::getUser()."'")[0]['id'];
        }else{
            return null;
        }
    }

    /**
     * Summary of login
     * 当前登录的用户角色
     * @return mixed | null 返回当前登录的用户角色
     */
    public function getUserIdentity()
    {
        if(!empty(self::getUser()))
        {
            return $this->db->select($this->userTableName,"where ".$this->userCol." = '".self::getUser()."'")[0]['identity'];
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