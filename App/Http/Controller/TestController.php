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
        $mail = new Mail(CONFIG);
        $mail->send('<EMAIL>', 'Test Email', 'eogee@qq.com', 'eogee');
    }

    public function fileUploadApi()
    {
        $responce = $this->file->userFileUploadApi();
        return $this->response->json($responce);
    }
}
