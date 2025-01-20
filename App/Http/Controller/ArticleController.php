<?php

namespace App\Http\Controller;
use App\Model\Article;

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
}