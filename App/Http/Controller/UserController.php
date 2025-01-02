<?php

namespace App\Http\Controller;

use Helper\Url;
use Helper\View;
use App\Model\Model;
use App\Model\User;
use app\Verify\Verify;
use App\Http\Response\Response;

/**
 * Summary of UserController
 * 用户管理 控制器
 */
class UserController extends BasicController
{    
    public static function listApi()
    {
        $data = Model::listApi('','username');
        $response = new Response;
        $response->json($data);
    }
    public static function recycleApi()
    {
        $data = Model::recycleApi('','username');
        $response = new Response;
        $response->json($data);
    }
    public static function checkUsernameApi()
    {
        $data = User::checkUsernameApi();
        $response = new Response;
        $response->json($data);
    }
    public static function updateApi()
    {
        $data = User::updateApi();
        $response = new Response;
        $response->json($data);
    }
    public static function insert()
    {
        Verify::adminLimit();
        View::view('/admin/'.Url::getTable().'/update');
        if(isset($_POST) and !empty($_POST)){
            User::insert();
        }
    }
    public static function edit()
    {
        Verify::adminLimit();
        $id = Url::getId();
        if(isset($id)){
            View::view('/admin/'.Url::getTable().'/update');
        }else{
            User::edit();
        }
    }
}
