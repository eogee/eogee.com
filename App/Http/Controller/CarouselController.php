<?php

namespace App\Http\Controller;

/**
 * Summary of CarouselController
 * 轮播图 控制器
 */
class CarouselController extends Controller
{    
    public function listApi()
    {
        $data = $this->model->listApi('carousel', 'title,keynote,content', 1, 10);
        $this->response->json($data);
    }
    public function recycleApi()
    {
        $data = $this->model->recycleApi('','title,keynote,content');
        $this->response->json($data);
    }
}
