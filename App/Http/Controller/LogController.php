<?php

namespace App\Http\Controller;


/**
 * Summary of LogController
 * 访问日志 控制器
 */
class LogController extends BasicController
{
    public function listApi()
    {
        $data = $this->model->listApi('log','ip,address,referrer');
        $this->response->json($data);
    }
}
