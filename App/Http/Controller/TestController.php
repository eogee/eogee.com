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
        /* 直接发送邮件 */
        /* $mail = new Mail();
        $mail->send('<h1>Hello</h1>','hello Eogeer','1274925805@qq.com','Zophar'); */
        
        /* 使用队列发送邮件 */
        $data = [
            'recipient' => '1274925805@qq.com',
            'subject' => 'Test',
            'message' => '<h1>test123</h1>'
        ];
        $queue = new EmailQueue;
        $queue->addToQueue($data);
        $queue->processQueue();

    }
}
