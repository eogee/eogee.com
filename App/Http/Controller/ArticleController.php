<?php

namespace App\Http\Controller;
use App\Model\Article;
use Easy\View\View;

class ArticleController extends Controller
{
    private $article;

    public function __construct()
    {
        parent::__construct();
        $this->article = new Article;
    }
    public function updateApi()
    {
        $data = $this->article->updateApi();
        $this->response->json($data);
    }
    public function detail()
    {
        $indexData = $this->headData();//获取前台头部数据
        $data = $this->model->show();
        $data = [
            'indexData' => $indexData
            ,'data' => $data
        ];
        View::view('/index/article/detail',$data);
    }
    public function detailApi()
    {
        echo $this->article->detailApi();
    }
}