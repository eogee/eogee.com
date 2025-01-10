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
    protected $tableName;//要操作的数据表名
    protected $db;//数据库操作对象
    protected $captcha;//图形验证码对象
    protected $session;
    protected $password;
    protected $verify;//验证对象
    public function __construct()
    {
        $this->tableName = CONFIG['database']['user_table'];

        $session = new Session;
        $this->captcha = new Captcha($session, CONFIG);
        
        $this->session = new Session;
        $this->verify = new UserVerify;
        $this->password = new Password($_POST['password']);
        $this->db = Database::getInstance();
    }

    /**
     * Summary of login
     * 登录验证
     * @return void
     */
    public function login()
    {
        if (!$this->verify->validate($_POST)) {
            Window::alert('请填写完整且符合格式的登录信息！', 'back');
            die();
        }else{
            $username = $_POST['username'];
            //$password = $_POST['password'];
            $captcha = $_POST['captcha'];

            // 验证图形验证码
            $this->captcha->checkCaptcha($captcha);

            // 查询用户是否存在
            $user = $this->db->select($this->tableName, "WHERE username = '$username' AND deleted_at IS NULL", );

            if (empty($user)) {
                Window::alert('输入的用户名或密码不正确！', 'back');
                die();
            }

            // 验证密码
            if ($this->password->verify($user[0]["password"])) {
                $this->session->set('username', $username);
                $this->session->set('csrf_token', $this->setCsrf());
                Window::redirect("/admin");
            } else {
                Window::alert('输入的用户名或密码不正确！', 'back');
            }
        }        
    }

    /**
     * Summary of register
     * 注册用户
     * @return void
     */
    public function register()
    {
        if (!$this->verify->validate($_POST)) {
            Window::alert('请填写完整且符合格式的注册信息！', 'back');
            die();
        }else{
            $username = $_POST['username'];
            //$password = $_POST['password'];
            $email = $_POST['email'];
            $captcha = $_POST['captcha'];

            // 验证图形验证码
            $this->captcha->checkCaptcha($captcha);

            // 查询用户是否存在
            $user = $this->db->select($this->tableName, "WHERE username = '$username' OR email = '$email' AND deleted_at IS NULL", );

            if (!empty($user)) {
                Window::alert('用户名或邮箱已存在！', 'back');
                die();
            }

            // 注册用户
            $data = [
                'username' => $username,
                'password' => $this->password->encrypt(),
                'email' => $email
            ];
            $this->db->insert($this->tableName, $data);
            $this->session->set('username', $username);
            $this->session->set('csrf_token', $this->setCsrf());
            Window::redirect("/");
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