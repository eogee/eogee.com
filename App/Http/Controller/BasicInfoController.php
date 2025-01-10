<?php

namespace App\Http\Controller;

use App\Http\Request\BasicInfoRequest;
use Easy\View\View;

/**
 * Summary of BasicInfoController
 * 网站基本信息 控制器
 */
class BasicInfoController extends Controller
{
    protected $request; //请求对象
    public function __construct()
    {
        parent::__construct();
        $this->request = new BasicInfoRequest;
    }
    public function edit()
    {
        $this->limitVerify->verify(); //权限验证
        $id = $this->id;
        if(isset($id)){
            View::view('/admin/'.$this->table.'/update');
        }else{
            if($this->request->request()){ //请求验证
                $this->response->json(['code' => 1,'msg' => '更新失败']);
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
