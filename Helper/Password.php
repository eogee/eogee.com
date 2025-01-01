<?php

namespace Helper;

/**
 * Password encryption and verification helper class
 * 密码加密和验证相关
 * @author <eogee.com> <<eogee@qq.com>>
 */
class Password
{
    /**
     * Encrypt password using md5
     * 使用md5加密密码
     * @param string $password 密码
     * @return string 加密后的密码
     */
    public static function encrypt($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    /**
     * Verify password using password_verify
     * 使用password_verify验证密码
     * @param string $password 密码
     * @param string $hashed_password 加密后的密码
     * @return bool 验证结果
     */
    public static function verify($password, $hashed_password)
    {
        return password_verify($password, $hashed_password);
    }
}