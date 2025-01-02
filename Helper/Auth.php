<?php

namespace Helper;

use App\Http\Request\Request;
use Helper\Session;
use Helper\Window;
use Helper\Database;
use Helper\Password;
use Helper\Captcha;

/**
 * Summary of Auth
 * 后台登录验证类
 * @author <eogee.com> <<eogee@qq.com>>
 */
class Auth
{    
    private static $tableName = CONFIG['database']['user_table'];#要操作的数据表名
    /**
     * Summary of login
     * 登录验证
     * @return void
     */
    public static function login()
    {
        // 获取并过滤用户名和密码
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $password = $_POST['password'];

        // 检查用户名和密码是否为空
        if (empty($username) || empty($password)) {
            Window::alert('请填写完整的登录信息！', 'back');
            die();
        }

        // 验证验证码
        Captcha::checkCaptcha();

        // 查询用户是否存在
        $user = Database::select(self::$tableName, "WHERE username = '$username' AND deleted_at IS NULL", );

        if (empty($user)) {
            Window::alert('输入的用户名或密码不正确！', 'back');
            die();
        }

        // 验证密码
        if (Password::verify($password, $user[0]["password"])) {
            Session::set('username', $username);
            Session::set('csrf_token', self::setCsrf());
            Window::redirect("/admin");
        } else {
            Window::alert('输入的用户名或密码不正确！', 'back');
        }
    }

    /**
     * Summary of logout
     * 退出登录
     * @return void
     */
    public static function logout()
    {
        Session::destroy();
        Window::alert('退出登录成功！','/auth/login');
    }
    /**
     * Summary of setCsrf
     * 设置csrf_token
     * @return string
     */
    public static function setCsrf()
    {
        return bin2hex(random_bytes(32));
    }

}