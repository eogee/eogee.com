<?php

namespace App\Verify;

use App\Verify\Verify;

class BasicInfoVerify extends Verify
{
    public function __construct()
    {
        // 设置验证规则
        $this->setRules([
            'title' => [
                'required' => true,
                'minLength' => 3,
                'maxLength' => 255
            ],
            'indexUrl' => [
                'required' => true,
                'minLength' => 3,
                'maxLength' => 255
            ],
            'keywords' => [
                'required' => true,
                'minLength' => 3,
                'maxLength' => 255
            ],
            'description' => [
                'required' => true,
                'minLength' => 3,
                'maxLength' => 255
            ],
            'logoAlt' => [
                'required' => true,
                'minLength' => 3,
                'maxLength' => 255
            ],
            'navToolName' => [
                'required' => true,
                'minLength' => 3,
                'maxLength' => 255
            ],
            'navToolUrl' => [
                'required' => true,
                'minLength' => 3,
                'maxLength' => 255
            ],
            'singlePageName' => [
                'required' => false,
                'maxLength' => 255
            ],
            'copyright' => [
                'required' => false,
                'maxLength' => 255
            ],
            'siteName' => [
                'required' => false,
                'maxLength' => 255
            ],
            'recordCode' => [
                'required' => false,
                'maxLength' => 255
            ]
        ]);
    }
}