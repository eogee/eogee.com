<?php

namespace App\Http\Controller;

use Easy\View\View;
use App\Model\News;
use Easy\Auth\Auth;
use App\Verify\UserVerify;
use App\Verify\UserRegisterVerify;
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
    protected $verify;
    protected $verifyRegister;
    protected $auth;
    protected $db;
    public function __construct()
    {
        parent::__construct();
        $this->verify = new UserVerify;
        $this->verifyRegister = new UserRegisterVerify;
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
    public function login()
    {
        if(isset($_POST["username"])){
            if (!$this->verifyRegister->validate($_POST)) {
                Window::alert('请填写完整且符合格式的登录信息！', 'back');
                die();
            }else{
                if($this->auth->register()){
                    $this->response->json(['code' => 0,'msg' => '注册成功！', 'url' => '/index']);
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
                    $this->response->json(['code' => 0,'msg' => '注册成功！', 'url' => '/index']);
                }
            }
        }else{
            $data = $this->db->select('basicinfo',"where id = 1")[0]['logoImage'];
            View::view('/index/auth/register',$data);
        }
    }
}
