<?php
namespace Controller;

use Helper\Url;
use Model\Model;
use Model\User;
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
        self::limit();
        require_once 'Resource/view/admin/'.Url::getTable().'/update.php';
        if(isset($_POST) and !empty($_POST)){
            User::insert();
        }
    }
    public static function edit()
    {
        self::limit();
        $id = Url::getId();
        if(isset($id)){
            require_once 'Resource/view/admin/'.Url::getTable().'/update.php';
        }else{
            User::edit();
        }
    }
}
