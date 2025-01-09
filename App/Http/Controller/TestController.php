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
        $mail->setFrom();
        $mail->addRecipient('1274925805@qq.com', 'user1');
        $mail->setSubject();
        $mail->setBody('test123', 'test123');
        $mail->send();
    }
    public function listApi()
    {
        $log = new Log;
        $data = $log->logByPage();
        $this->response->json($data);
    }
}
