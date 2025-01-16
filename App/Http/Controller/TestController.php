<?php

namespace App\Http\Controller;

use Easy\Log\Log;
use Easy\View\View;
use Easy\Mail\Mail;
use App\Queue\EmailQueue;

class TestController extends Controller
{
    
    public function index()
    {
        $indexData = $this->headData();//获取前台头部数据
        $data = [
            'indexData' => $indexData
        ];
        View::view('/test',$data);
    }
}
