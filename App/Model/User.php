<?php
namespace App\Model;

use Helper\Url;
use Helper\Window;
use Easy\Password\Password;
use App\Verify\Verify;

/**
 * 用户管理 模型
 */
class User extends Model
{
    /**
     * Summary of checkUsernameApi
     * 检查用户名是否存在 API
     */
    public function checkUsernameApi()
    {
        // 获取 username
        $username = $this->id;

        // 安全处理
        $username = $this->db->conn->real_escape_string($username);

        // 查询数据库判断用户名是否存在
        $usernameExist = $this->db->select(Url::getTable(), "WHERE username = '$username'");
        
        if (count($usernameExist) > 0) {
            return [
                'code' => 1
                ,'msg' => '用户名已存在'
            ];
        }else{
            return [
                'code' => 0
                ,'msg' => '用户名可用'
            ];
        }
    }
    /**
     * Summary of checkUsernameApi
     * 检查邮箱是否存在 API
     */
    public function checkEmailApi()
    {
        // 获取 email
        $email = $_POST['email'];

        // 安全处理
        $email = $this->db->conn->real_escape_string($email);

        // 查询数据库判断email是否存在
        $emailExist = $this->db->select(Url::getTable(), "WHERE email = '$email'");
        
        if (count($emailExist) > 0) {
            return [
                'code' => 1
                ,'msg' => '该邮箱已存在'
            ];
        }else{
            return [
                'code' => 0
                ,'msg' => '该邮箱未被注册'
            ];
        }
    }

    /**
     * Summary of updateApi
     * 编辑用户信息 API 
     */
    public function updateApi()
    {
        //todo: 验证用户权限
        // 获取 ID
        $username = $this->id;
    
        // 验证 ID 是否有效
        if (empty($username)) {
            $data = [
                'code' => 100,
                'msg' => 'ID 不能为空',
                'data' => []
            ];
        }
    
        // 获取相关数据
        $data = $this->show(); // 获取数据
        $nullable = $this->columnIsnullable(); // 获取字段是否可空
        $options = $this->db->selectCol('role', "id, name"); // 获取角色选项
    
        // 构建响应数组
        return $data = [
            'code' => 0,
            'msg' => 'success',
            'data' => !empty($data['data']) ? $data['data'] : [], // 确保数据存在
            'field' => !empty($data['field']) ? $data['field'] : [], // 确保字段存在
            'nullable' => $nullable,
            'options' => !empty($options) ? $options : [], // 确保选项存在
            'csrf_token' => $_SESSION['csrf_token'] ?? '', // 确保 CSRF Token 存在
            'enter' => $_SESSION['username'] ?? 'Guest', // 设置用户名称为 'Guest'
            'enterId' => $this->session->getUserId() ?? null // 确保返回有效的用户 ID
        ];
    }

    /**
     * Summary of insert
     * 插入数据
     * @return string 插入结果信息
     */
    public function insert()
    {
        // 验证 CSRF Token
        Verify::crsfVerify();

        // 移除不需要的字段
        if (isset($_POST['file'])) {
            unset($_POST['file']); // 移除 file 字段，如果存在
        }

        // 验证 POST 数据是否有效
        if (empty($_POST) || !is_array($_POST)) {
            return "没有有效的数据进行插入"; // 返回错误信息
        }

        // 验证密码是否一致
        if ($_POST['password'] !== $_POST['passwordRepeat']) {
            return "两次输入密码不一致，请重新输入！"; // 返回错误信息
        }

        unset($_POST['passwordRepeat']); // 移除 passwordRepeat 字段，如果存在

        // 检查用户名是否已存在
        $username = $_POST['username'];
        $usernameExist = $this->db->select(Url::getTable(), "WHERE username = '" . $this->db->conn->real_escape_string($username) . "'");
        if (count($usernameExist) > 0) {
            return "该用户名已存在！"; // 返回错误信息
        }

        // 处理密码加密
        if (!empty($_POST['password'])) {
            $Password = new Password($_POST['password']); // 密码加密
            $_POST['password'] = $Password->encrypt();
        }

        // 执行插入操作并返回结果
        return $this->db->insert(Url::getTable(), $_POST);
    }
    
    /**
     * Summary of edit
     * 编辑用户信息
     * @param mixed $id 
     * @param mixed $table
     * @return mixed
     */
    public function edit($table = null)
    {
        // 验证 CSRF Token
        Verify::crsfVerify();

        // 获取有效表名
        if (empty($table)) {
            $table = Url::getTable();
        }

        // 获取 ID
        $id = $_POST['id'] ?? null;

        // 参数验证
        if (empty($id) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['passwordRepeat'])) {
            Window::alert('请填写完整的用户信息！');
            die();
        }

        // 获取旧密码和旧用户名
        $userData = $this->db->select($table, "WHERE id = " . intval($id));
        if (empty($userData)) {
            Window::alert('用户不存在！');
            die();
        }

        $passwordOld = $userData[0]['password'];
        $usernameOld = $userData[0]['username'];

        // 检查密码是否一致
        if ($_POST['password'] !== $_POST['passwordRepeat']) {
            Window::alert('两次输入密码不一致，请重新输入！');
            die();
        }

        // 检查用户名是否已存在
        $username = $_POST['username'];
        if ($username !== $usernameOld) {
            $usernameExist = $this->db->select($table, "WHERE username = '" . $this->db->conn->real_escape_string($username) . "'");
            if (count($usernameExist) > 0) {
                Window::alert('该用户名已存在！');
                die();
            }
        }

        // 处理密码更新
        if ($_POST['password'] !== $passwordOld) {
            $Password = new Password($_POST['password']); // 密码加密
            $password = $Password->encrypt();
        } else {
            $password = $passwordOld; // 如果密码未更改，使用旧密码
        }

        // 准备更新数据
        $dataToUpdate = [
            'username' => $username,
            'password' => $password,
            'nickname' => $_POST['nickname'],
            'email' => $_POST['email'],
            'identity' => $_POST['identity'],
            'adminRoleId' => $_POST['adminRoleId']
        ];

        // 执行更新
        $result = $this->db->update($table, $dataToUpdate, "WHERE id = " . intval($id));

        // 处理更新结果
        if (is_string($result)) {
            return $result; // 如果返回的是字符串，则为错误信息
        }

        return true; // 返回成功信息
    }
}
