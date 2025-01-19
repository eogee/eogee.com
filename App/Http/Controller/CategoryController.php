<?php

namespace App\Http\Controller;

use App\Http\Request\CategoryRequest;
use Easy\View\View;

class CategoryController extends Controller
{
    protected $request; //请求对象
    public function __construct()
    {
        parent::__construct();
        $this->request = new CategoryRequest;
    }

    public function insert()
    {
        $this->verify->adminLimit();

        if(isset($_POST) and !empty($_POST)){
            if($this->request->request()){ //请求验证
                $this->response->json(['code' => 1,'msg' => '数据格式验证失败']);
            }else{
                if($this->model->insert()){ //插入数据
                    $this->response->json(['code' => 0,'msg' => '插入成功']);
                }else{
                    $this->response->json(['code' => 1,'msg' => '插入失败']);
                }
            }
        }else{
            View::view('/admin/'.$this->table.'/update');
        }

        
    }
    public function edit()
    {
        $this->verify->adminLimit();
        $id = $this->id;
        if(isset($id)){
            View::view('/admin/'.$this->table.'/update');
        }else{
            if($this->request->request()){ //请求验证
                $this->response->json(['code' => 1,'msg' => '数据格式验证失败']);
            }else{
                if($this->model->edit()){ //更新数据
                    $this->response->json(['code' => 0,'msg' => '更新成功']);
                }else{
                    $this->response->json(['code' => 1,'msg' => '更新失败']);
                }
            }
        }
    }
}
