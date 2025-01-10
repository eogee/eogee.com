<?php

namespace Easy\Password;

/**
 * Password encryption and verification helper class
 * 密码加密和验证相关
 * @author Eogee
 * @email eogee@qq.com 
 */
class Password
{
    private $password; // 原始密码

    public function __construct($password)
    {
        $this->password = $password;
    }

    /**
     * Encrypt password
     * 加密密码
     * @param string $password 密码
     * @return string 加密后的密码
     */
    public function encrypt()
    {
        return password_hash($this->password, PASSWORD_DEFAULT);
    }
    /**
     * Verify password using password_verify
     * 使用password_verify验证密码
     * @param string $password 密码
     * @param string $hashed_password 加密后的密码
     * @return bool 验证结果
     */
    public function verify($hashed_password)
    {
        return password_verify($this->password, $hashed_password);
    }
}