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
        $data = $this->headData();//获取前台头部数据
        View::view('/index/article/detail',$data);
    }
    public function detailApi()
    {
        /* $data = $this->article->detailApi();
        $this->response->json($data); */
    }
}