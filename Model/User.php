<?php
namespace Model;

/**
 * 用户管理 模型
 */
class User extends Model
{
    public static function checkUsernameApi()
    {
        $username = Model::getId();
        $usernameExist = Database::select(self::getTable(),"where username = '$username'");
        if(count($usernameExist)>0) {
            echo 'true';
        }
    }
    public static function updateApi()
    {
        $id = self::getId();
        $data = self::show();
        $nullable = self::columnIsnullable();
        $options = Database::selectCol('role',"id,name");
        if(empty($id)){
            $data['data'] = [];
        }
        $arr = [
            'code' => 0
            ,'msg' => 'success'
            ,'data' => $data['data']
            ,'field' => $data['field']
            ,'nullable' => $nullable
            ,'options' => $options
            ,'csrf_token' => $_SESSION['csrf_token']
            ,'enter' => $_SESSION['username']
            ,'enterId' => self::getUserId()
        ];
        header('Content-Type: application/json');
        echo json_encode($arr);
    }
    public static function insert(){
        self::crsfVerify();
        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordRepeat = $_POST['passwordRepeat'];
        if(empty($username) || empty($password) || empty($passwordRepeat)) {
            Model::errorResponce('请填写完整的用户信息！');
            die();
        }
        if($password != $passwordRepeat) {
            Model::errorResponce('两次输入密码不一致，请重新输入！');
            die();
        }
        $usernameExist = Database::select(self::getTable(),"where username = '$username'");
        if(count($usernameExist)>0) {
            Model::errorResponce('该用户名已存在！');
            die();
        }else{
            $password = password_hash($password, PASSWORD_DEFAULT);
            $_POST['username'] = $username;
            $_POST['password'] = $password;
            unset($_POST['passwordRepeat']);
            Database::insert(self::getTable(),$_POST);
        }
    }
    public static function edit($table = null)
    {
        self::crsfVerify();
        if(empty($table)) {
            $table = self::getTable();
        }

        $id = $_POST['id'];
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordRepeat = $_POST['passwordRepeat'];
        $passwordOld =Database::select($table,"where id = $id")[0]['password'];
        $usernameOld =Database::select($table,"where id = $id")[0]['username'];
        if(empty($username) || empty($password) || empty($passwordRepeat)) {
            Model::errorResponce('请填写完整的用户信息！');
            die();
        }
        if($password != $passwordRepeat) {
            Model::errorResponce('两次输入密码不一致，请重新输入！');
            die();
        }
        if($username != $usernameOld){
            $usernameExist = Database::select($table,"where username = '$username'");
            if(count($usernameExist)>0) {
                Model::errorResponce('该用户名已存在！');
                die();
            }else{
                if($password != $passwordOld){
                    $password = password_hash($password, PASSWORD_DEFAULT);                    
                }
                unset($_POST['passwordRepeat']);
                $_POST['username'] = $username;
                $_POST['password'] = $password;
                return Database::update($table, $_POST, "where id = ".$id);              
            }
        }else{
            if($password != $passwordOld){
                $password = password_hash($password, PASSWORD_DEFAULT);
            }
            unset($_POST['passwordRepeat']);
            $_POST['username'] = $username;
            $_POST['password'] = $password;
            return Database::update($table, $_POST, "where id = ".$id);
        }
    }
}
