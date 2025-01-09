<?php

namespace App\Http\Controller;

use Easy\Log\Log;
use Easy\View\View;
use Easy\Mail\Mail;

class TestController extends BasicController
{
    public function index()
    {
        $mail = new Mail();
        $mail->send('<h1>Hello</h1>','hello Eogeer','1274925805@qq.com','Zophar');
    }
    // public function listApi()
    // {
    //     $log = new Log;
    //     $data = $log->logByPage();
    //     $this->response->json($data);
    // }
}
