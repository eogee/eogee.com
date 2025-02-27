<?php

namespace App\Http\Controller;
use App\Model\Article;
use Easy\View\View;
use Easy\Database\Database;

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
        $db = Database::getInstance(CONFIG);
        $indexData = $this->headData();//获取前台头部数据
        $data = $this->article->show();
        $list = $db->selectCol('article', "id, title,categoryName","where memberContent = 0","sort","ASC");

        $data = [
            'indexData' => $indexData
            ,'data' => $data
            ,'list' => $list
        ];
        View::view('/index/article/detail',$data);
    }
    public function detailApi()
    {
        $data = $this->article->detailApi();
        $this->response->text($data);
    }
    public function insert()
    {
        $this->verify->adminLimit();
        if(isset($_POST) and !empty($_POST)){
            if($this->article->insert() > 0){
                $this->response->json(['code' => 0,'msg' => '新增成功']);
            }else{
                $this->response->json(['code' => 1,'msg' => '新增失败']);
            }
        }else{
            View::view('/admin/article/update');
        }
    }
    public function edit()
    {
        $this->verify->adminLimit();
        $id = $this->id;
        if(isset($id)){
            View::view('/admin/article/update');
        }else{
            if($this->article->edit()){
                $this->response->json(['code' => 0,'msg' => '更新成功']);
            }else{
                $this->response->json(['code' => 1,'msg' => '更新失败']);
            }
        }
    }
}