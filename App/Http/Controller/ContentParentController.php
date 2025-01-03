<?php

namespace App\Http\Controller;

/**
 * Summary of ContentParentController
 * 内容中心 控制器
 */
class ContentParentController extends BasicController
{
    
    public function listApi()
    {
        $data = $this->model->listApi('','title,keynote');
        $this->response->json($data);
    }
    public function recycleApi()
    {
        $data = $this->model->recycleApi('','title,keynote');
        $this->response->json($data);
    }
}
