<?php

namespace App\Http\Controller;

/**
 * Summary of FootUrlController
 * 底部链接 控制器
 */
class FootUrlController extends Controller
{
    
    public function listApi()
    {
        $data = $this->model->listApi('','name');
        $this->response->json($data);
    }
    public function recycleApi()
    {
        $data = $this->model->recycleApi('','name');
        $this->response->json($data);
    }
}
