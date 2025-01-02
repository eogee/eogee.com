<?php

namespace App\Verify;

/**
 * Summary of Verify
 * 验证类
 * @author <eogee.com> <<eogee@qq.com>>
 */
class Verify{
    /**
     * 验证CSRF攻击
     */
    public static function crsfVerify()
    {
        if(empty($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf_token']) {
            die('CSRF attack detected!');
        }else{
            unset($_POST['csrf']);
        }
    }
}