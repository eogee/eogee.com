<?php

namespace App\Http\Controller;

use Easy\View\View;
use Helper\Url;
use App\Model\User;
use app\Verify\Verify;

/**
 * Summary of UserController
 * 用户管理 控制器
 */
class UserController extends BasicController
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
    public function updateApi()
    {
        $data = $this->user->updateApi();
        $this->response->json($data);
    }
    public function insert()
    {
        Verify::adminLimit();
        View::view('/admin/'.Url::getTable().'/update');
        if(isset($_POST) and !empty($_POST)){
            $this->user->insert();
        }
    }
    public function edit()
    {
        Verify::adminLimit();
        $id = Url::getId();
        if(isset($id)){
            View::view('/admin/'.Url::getTable().'/update');
        }else{
            $this->user->edit();
        }
    }
}
