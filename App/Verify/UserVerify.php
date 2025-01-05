<?php

namespace App\Verify;

class UserVerify extends Verify
{
    public function __construct()
    {
        // 设置验证规则
        $this->setRules([
            'username' => [
                'required' => true,
                'minLength' => 3,
                'maxLength' => 16
            ],
            'password' => [
                'required' => true,
                'minLength' => 6,
                'maxLength' => 16
            ],
        ]);
    }
}