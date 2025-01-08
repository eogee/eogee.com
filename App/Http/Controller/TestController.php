<?php

namespace App\Http\Controller;

use Easy\Log\Log;
use Easy\View\View;

class TestController extends BasicController
{
    public function index()
    {
        $log = new Log;

        $log->logToArray();

        //View::view('/test');
    }
    public function listApi()
    {
        $log = new Log;

        $data = $log->logByPage();

        $this->response->json($data);
    }
}
