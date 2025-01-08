<?php

namespace App\Http\Controller;

use Easy\Log\Log;
use Easy\View\View;

class TestController extends BasicController
{
    public function index()
    {
        //日志文件下载测试

        //$log = new Log;

        //$log->downloadLog();

        View::view('/test');
    }
    public function listApi()
    {
        $log = new Log;

        $data = $log->logByPage();

        $this->response->json($data);
    }
}
