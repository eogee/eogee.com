<?php

namespace App\Http\Controller;

use Helper\Window;
use App\Model\SmallStove;

class SmallStoveController extends Controller
{
    private $smallStove;
    public function submit()
    {        
        
        $username = $this->session->getUser();
        $_POST = $_GET;
        if(isset($_POST) and !empty($_POST) and !empty($username)){
            $this->smallStove = new SmallStove();
            if($this->smallStove->submit() > 0){
                $this->response->json(['code' => 0,'msg' => '新增成功']);
            }else{
                $this->response->json(['code' => 1,'msg' => '新增失败']);
            }
        }else{
            Window::alert('请先登录或注册！','back');
        }
    }   

}