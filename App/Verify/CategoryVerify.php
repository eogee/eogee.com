<?php

namespace App\Verify;

class CategoryVerify extends Verify
{
    public function __construct()
    {
        // 设置验证规则
        $this->setRules([
            'name' => [
                'required' => true,
                'maxLength' => 255
            ],
            'keywords' => [
                'required' => true,
                'maxLength' => 255
            ],
            'description' => [
                'required' => true,
                'maxLength' => 255
            ],
            'sort' => [
                'required' => false,
                'maxLength' => 11
            ]
        ]);
    }
}
