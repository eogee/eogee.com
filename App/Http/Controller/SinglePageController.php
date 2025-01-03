<?php

namespace App\Http\Controller;

use Helper\Window;

/**
 * Summary of SinglePageController
 * 单页内容 控制器
 */
class SinglePageController extends BasicController
{    
    public function listApi()
    {
        $data = $this->model->listApi('','title,keynote,content');
        $this->response->json($data);
    }
    public function recycleApi()
    {
        $data = $this->model->recycleApi('','title,keynote,content');
        $this->response->json($data);
    }
    public static function support()
    {
        Window::redirect('/singlePage/detail/2');
    }
}
