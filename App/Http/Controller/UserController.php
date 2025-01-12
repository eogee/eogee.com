<?php

namespace App\Http\Controller;

use Easy\View\View;
use Helper\Url;
use App\Model\User;

/**
 * Summary of UserController
 * 用户管理 控制器
 */
class UserController extends Controller
{    
    protected $user;
    public function __construct()
    {
        parent::__construct();
        $this->user = new User;
    }
    public function listApi()
    {
        $data = $this->user->listApi('','username');
        $this->response->json($data);
    }
    public function recycleApi()
    {
        $data = $this->user->recycleApi('','username');
        $this->response->json($data);
    }
    public function checkUsernameApi()
    {
        $data = $this->user->checkUsernameApi();
        $this->response->json($data);
    }
    public function checkEmailApi()
    {
        $data = $this->user->checkEmailApi();
        $this->response->json($data);
    }
    public function updateApi()
    {
        $data = $this->user->updateApi();
        $this->response->json($data);
    }
    public function insert()
    {
        $this->verify->adminLimit();
        View::view('/admin/'.Url::getTable().'/update');
        if(isset($_POST) and !empty($_POST)){
            if($this->user->insert() > 0){
                $this->response->json(['code' => 0,'msg' => '新增成功']);
            }else{
                $this->response->json(['code' => 1,'msg' => '新增失败']);
            }
        }
    }
    public function edit()
    {
        $this->verify->adminLimit();
        $id = Url::getId();
        if(isset($id)){
            View::view('/admin/'.Url::getTable().'/update');
        }else{
            if($this->user->edit()){
                $this->response->json(['code' => 0,'msg' => '更新成功']);
            }else{
                $this->response->json(['code' => 1,'msg' => '更新失败']);
            }
        }
    }
}
