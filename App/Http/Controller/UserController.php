<?php

namespace App\Http\Controller;

use Helper\Url;
use Helper\View;
use App\Model\Model;
use App\Model\User;
use App\Http\Request\Request;

/**
 * Summary of UserController
 * 用户管理 控制器
 */
class UserController extends BasicController
{    
    public static function listApi()
    {
        Model::listApi('','username');
    }
    public static function recycleApi()
    {
        Model::recycleApi('','username');
    }
    public static function checkUsernameApi()
    {
        User::checkUsernameApi();
    }
    public static function updateApi()
    {
        User::updateApi();
    }
    public static function insert()
    {
        Request::adminLimit();
        View::view('/admin/'.Url::getTable().'/update');
        if(isset($_POST) and !empty($_POST)){
            User::insert();
        }
    }
    public static function edit()
    {
        Request::adminLimit();
        $id = Url::getId();
        if(isset($id)){
            View::view('/admin/'.Url::getTable().'/update');
        }else{
            User::edit();
        }
    }
}
