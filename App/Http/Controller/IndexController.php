<?php

namespace App\Http\Controller;

use Easy\View\View;
use App\Model\News;
use Easy\Auth\Auth;
use App\Verify\UserVerify;
use App\Verify\UserRegisterVerify;
use App\Verify\UserForgetVerify;
use Helper\Window;
use Easy\Database\Database;

/**
 * Summary of IndexController
 * 前台首页 控制器
 * @author Eogee
 * @email eogee@qq.com 
 */
class IndexController extends Controller
{
    protected $news;
    protected $verify; // 登录表单验证
    protected $verifyRegister; // 注册表单验证
    protected $verifyForget; // 重置表单验证
    protected $auth;
    protected $db;
    public function __construct()
    {
        parent::__construct();
        $this->verify = new UserVerify;
        $this->verifyRegister = new UserRegisterVerify;
        $this->verifyForget = new UserForgetVerify;
        $this->db = Database::getInstance(CONFIG);
        $this->news = new News;
        $this->auth = new Auth(CONFIG);
    }
    /**
     * Summary of index
     * 首页控制器，显示首页内容
     * 轮播图、产品中心、服务中心、课程中心、产品动态、课程动态、赞助商、友情链接
     */
    public function index()
    {
        $data = [
            'indexData' => $this->headData(),
            'content' => $this->model->showAll('contentParent','','sort','','content'),
            'carousel' => $this->model->showAll('carousel','','sort'),
            'news' => $this->news->showAll()
        ];

        View::view('/index/index',$data);
    }
    public function getUserSessionInfo()
    {
        if (isset($_SESSION['username'])) {
            echo json_encode(['username' => $_SESSION['username']]);
        } else {
            echo json_encode(['username' => null]);
        }
    }
    public function login()
    {
        if(isset($_POST["username"])){
            if (!$this->verify->validate($_POST)) {
                Window::alert('请填写完整且符合格式的登录信息！', 'back');
                die();
            }else{
                if($this->auth->login()){
                    $this->response->json(['code' => 0,'msg' => '登录成功！', 'url' => '/index']);
                }else{
                    $this->response->json(['code' => 1,'msg' => '登录失败！']);
                }
            }
        }else{
            $data = $this->db->select('basicinfo',"where id = 1")[0]['logoImage'];
            View::view('/index/auth/login',$data);
        }
    }
    public function register()
    {
        if(isset($_POST["username"])){
            if (!$this->verifyRegister->validate($_POST)) {
                $this->response->json(['code' => 1,'msg' => '请填写完整且符合格式的注册信息！']);
            }else{
                if($this->auth->register()){
                    $this->response->json(['code' => 0,'msg' => '注册成功！', 'url' => '/index/login']);
                }else{
                    $this->response->json(['code' => 1,'msg' => '注册失败！']);
                }
            }
        }else{
            $data = $this->db->select('basicinfo',"where id = 1")[0]['logoImage'];
            View::view('/index/auth/register',$data);
        }
    }
    public function forget()
    {
        if(isset($_POST["email"])){
            if (!$this->verifyForget->validate($_POST)) {
                $this->response->json(['code' => 1,'msg' => '请填写完整且符合格式的表单信息！']);
            }else{
                if($this->auth->resetPasswordByEmail()){
                    $this->response->json(['code' => 0,'msg' => '重置成功！', 'url' => '/index/login']);
                }else{
                    $this->response->json(['code' => 1,'msg' => '重置失败！']);
                }
            }
        }else{
            $data = $this->db->select('basicinfo',"where id = 1")[0]['logoImage'];
            View::view('/index/auth/forget',$data);
        }
    }
    public function personal()
    {
        View::view('/index/personal');
    }
    public function logout()
    {
        $this->auth->logout();
        $this->response->redirect('/index');
    }

}
