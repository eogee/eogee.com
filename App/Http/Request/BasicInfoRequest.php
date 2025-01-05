<?php

namespace App\Http\Request;

use App\Verify\BasicInfoVerify;

/**
 * Summary of Request
 * 请求类
 * @author Eogee
 * @email eogee@qq.com 
 */
class BasicInfoRequest extends Request
{
    public $verify;
    public function request()
    {
        $this->verify = new BasicInfoVerify;
        $cols = [
            'titleIcon'
            ,'logoImage'
        ];
        if ($this->verify->validate($this->allExc($cols))) {
            return false;
        }
        return true;
    }
}