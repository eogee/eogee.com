<?php

namespace App\Http\Controller;

use Easy\View\View;
use Helper\Url;
use App\Model\User;
use Easy\Captcha\Captcha;
use App\Queue\EmailQueue;

/**
 * Summary of UserController
 * 用户管理 控制器
 */
class UserController extends Controller
{    
    protected $user;
    protected $captcha;
    protected $queue;
    public function __construct()
    {
        parent::__construct();
        $this->user = new User;
        $this->captcha = new Captcha($this->session,CONFIG);
        $this->queue = new EmailQueue(CONFIG);
    }
    public function listApi()
    {
        $data = $this->user->listApi('','username,email');
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
    public function checkCaptchaApi()
    {
        if(!$this->captcha->checkCaptcha($_POST['captcha'])){
            $this->response->json(['code' => 1,'msg' => '图形验证码错误']);
        }else{
            $this->response->json(['code' => 0,'msg' => '验证成功']);
        }
    }
    public function sendEmailCaptchaApi()
    {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $captcha = $this->captcha->setEmailCaptcha();
        //发送邮件验证码
        $data = [
            'recipient' => $email,
            'subject' => 'Email verification code',
            'message' => "<h2>Hello $username,</h2><h1>您的验证码是:$captcha</h1>" 
        ];
        $this->queue->addToQueue($data);//添加到队列
        if($this->queue->processQueue()){
            $this->response->json(['code' => 0,'msg' => '验证码已发送至邮箱']);
        }else{
            $this->response->json(['code' => 1,'msg' => '验证码发送失败']);
        }
    }
    public function checkEmailCaptchaApi()
    {
        if(!$this->captcha->checkEmailCaptcha($_POST['emailCaptcha'])){
            $this->response->json(['code' => 1,'msg' => '邮箱验证码错误']);
        }else{
            $this->response->json(['code' => 0,'msg' => '验证成功']);
        }
    }
    public function updateApi()
    {
        $data = $this->user->updateApi();
        $this->response->json($data);
    }
    public function insert()
    {
        $this->verify->adminLimit(); // 权限限制

        if(isset($_POST) and !empty($_POST)){
            if($this->user->insert() > 0){
                $this->response->json(['code' => 0,'msg' => '新增成功']);
            }else{
                $this->response->json(['code' => 1,'msg' => '新增失败']);
            }
        }else{
            View::view('/admin/'.Url::getTable().'/update');
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
