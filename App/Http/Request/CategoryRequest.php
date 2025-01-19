<?php

namespace App\Http\Request;

use App\Verify\CategoryVerify;

class CategoryRequest extends Request
{
    public $verify;
    public function request()
    {
        $this->verify = new CategoryVerify;

        if ($this->verify->validate($this->all())) {
            return false;
        }
        return true;
    }

}
