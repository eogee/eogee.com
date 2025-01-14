<?php

namespace App\Verify;

class UserForgetVerify extends Verify
{
    public function __construct()
    {
        // 设置验证规则
        $this->setRules([
            'email' => [
                'required' => true,
                'minLength' => 6,
                'maxLength' => 30,
                'regex' => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                'exists' => 'user'
            ],
            'captcha' => [
                'required' => true,
                'minLength' => 4,
                'maxLength' => 4,
                'session' => 'captcha'
            ],
            'emailCaptcha' => [
                'required' => true,
                'minLength' => 6,
                'maxLength' => 6,
                'session' => 'emailCaptcha'
            ],
            'password' => [
                'required' => true,
                'minLength' => 6,
                'maxLength' => 16
            ],
            'passwordRepeat' => [
                'required' => true,
                'minLength' => 6,
                'maxLength' => 16,
                'equal' => 'password'
            ]
        ]);
    }
}
