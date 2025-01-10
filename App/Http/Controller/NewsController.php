<?php

namespace App\Http\Controller;

use Easy\View\View;
use App\Model\News;

/**
 * Summary of NewsController
 * 最新动态 控制器
 */
class NewsController extends Controller
{
    protected $news;

    public function __construct()
    {
        parent::__construct();
        $this->news = new News;
    }
    public function index()
    {
        $indexData = $this->headData();
        $data = $this->news->showAll();
        $data = [
            'indexData' => $indexData,
            'data' => $data
        ];
        View::view('/index/'.$this->table,$data);
    }
    public function updateApi()
    {
        $data = $this->news->updateApi();
        $this->response->json($data);
    }
    public function edit()
    {
        $this->limitVerify->verify();
        $id = $this->id;
        if(isset($id)){
            View::view('/admin/'.$this->table.'/update');
        }else{
            $this->model->edit();
        }
    }
}
