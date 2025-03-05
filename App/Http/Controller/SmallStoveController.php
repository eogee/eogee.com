<?php

namespace App\Http\Controller;

use Easy\View\View;
use Helper\Window;

class SmallStoveController extends Controller
{
    public function submit()
    {
        $username = $this->session->getUser();
        if(isset($_POST) and !empty($_POST) and !empty($username)){
            if($this->model->insert() > 0){
                $this->response->json(['code' => 0,'msg' => '新增成功']);
            }else{
                $this->response->json(['code' => 1,'msg' => '新增失败']);
            }
        }else{
            Window::alert('请先登录或注册！');
        }
    }   

}