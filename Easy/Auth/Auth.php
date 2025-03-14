<?php

namespace Easy\Auth;

use App\Verify\UserVerify;
use Easy\Session\Session;
use Easy\Database\Database;
use Easy\Captcha\Captcha;
use Easy\Password\Password;
use Helper\Window;

/**
 * Summary of Auth
 * 后台登录验证类
 * @author Eogee
 * @email eogee@qq.com 
 */
class Auth
{    
    protected $tableName; // 要操作的数据表名
    protected $db; // 数据库操作对象
    protected $captcha; // 图形验证码对象
    protected $session; // session对象
    protected $password; // 密码加密对象
    protected $verify;//验证对象
    public function __construct($config)
    {
        $this->tableName = $config['database']['user_table'];

        $session = new Session($config);
        $this->captcha = new Captcha($session, $config);
        
        $this->session = new Session($config);
        $this->verify = new UserVerify;
        $this->password = new Password($_POST['password']);
        $this->db = Database::getInstance($config);
    }

    /**
     * Summary of login
     * 登录验证
     * @return bool|string
     */
    public function login()
    {    
        $username = $_POST['username'];
        $captcha = $_POST['captcha'];
    
        // 验证图形验证码
        if (!$this->captcha->checkCaptcha($captcha)) {
            return '验证码不正确！';
        }
    
        // 查询用户是否存在
        $user = $this->getUserByUsername($username);
        if (empty($user)) {
            return '输入的用户名或密码不正确！';
        }

        // 验证密码
        if ($this->password->verify($user[0]["password"])) {
            $this->createUserSession($user[0]['username']);
            // 登录验证成功，删除session中的图形验证码
            $this->session->delete('captcha');
            return true;
        } else {
            return '输入的用户名或密码不正确！';
        }        
    }

    /**
     * Summary of getUserByUsername
     * 根据用户名查询用户信息
     * @param string $username 用户名
     * @return array 用户信息
     */
    private function getUserByUsername($username)
    {
        // 判定用户输入的是否为邮箱
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $where = "WHERE email = '$username' AND deleted_at IS NULL";
            return $this->db->select($this->tableName, $where);
        }else{
            return $this->db->select($this->tableName, "WHERE username = '$username' AND deleted_at IS NULL");
        }        
    }

    /**
     * Summary of createUserSession
     * 创建用户session
     * @param string $username 用户名
     * @param string $identity 用户身份
     * @param string $csrf_token csrf_token
     * @return void
     */
    private function createUserSession($username)
    {
        $this->session->set('username', $username);
        $this->session->set('user_identity', $this->getUserByUsername($username)[0]['identity']);
        $this->session->set('csrf_token', $this->setCsrf());
    }

    /**
     * Summary of register
     * 注册用户
     * @return bool
     */
    public function register()
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $identity = '用户'; // 用户身份：默认用户

        // 密码哈希处理
        $hashedPassword = $this->password->encrypt();

        // 插入用户信息到数据库
        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword,
            'identity' => $identity
        ];
        
        // 执行数据库插入操作
        if ($this->db->insert($this->tableName, $data)>0) {
            $this->session->delete('captcha');
            $this->session->delete('emailCaptcha');
            return true;
        } else {
            return false;
        }
    }

    // 根据邮箱重置密码
    public function resetPasswordByEmail()
    {
        $email = $_POST['email'];

        // 密码哈希处理
        $hashedPassword = $this->password->encrypt();

        // 更新用户密码
        $data = [
            'password' => $hashedPassword
        ];
        $where = "where email = '$email'";
        if ($this->db->update($this->tableName, $data, $where)>0) {
            $this->session->delete('captcha');
            $this->session->delete('emailCaptcha');
            return true;
        } else {
            return false;
        }
    }

    /**
     * Summary of logout
     * 退出登录
     * @return void
     */
    public function logout()
    {
        Session::destroy();
        Window::alert('退出登录成功！','/auth/login');
    }
    
    /**
     * Summary of setCsrf
     * 设置csrf_token
     * @return string
     */
    public function setCsrf()
    {
        return bin2hex(random_bytes(32));
    }

}