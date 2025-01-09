<?php

namespace App\Http\Controller;

use Easy\Log\Log;
use Easy\View\View;
use Easy\Mail\Mail;

class TestController extends BasicController
{
    public function index()
    {
        $mail = new Mail('smtp.qq.com', 'eogee@qq.com', 'udcfyfojkbdfcdhj',587);
        $mail->setFrom('eogee@qq.com', 'eogee');
        $mail->addRecipient('1274925805@qq.com', 'user1');
        $mail->setSubject('test');
        $mail->setBody('test', 'test');
        $mail->send();
    }
    public function listApi()
    {
        $log = new Log;
        $data = $log->logByPage();
        $this->response->json($data);
    }
}
