<?php

namespace App\Http\Controller;

use Easy\Log\Log;
use Easy\Database\Database;
use Helper\Url;

/**
 * Summary of LogController
 * 访问日志 控制器
 */
class LogController extends Controller
{
    public $log;//日志类

    private $fieldComments;
    
    public function __construct()
    {
        parent::__construct();

        $db = Database::getInstance(CONFIG);
        $this->log = new Log($db,CONFIG);

        $this->fieldComments = [
            'timestamp'=>'请求时间'
            ,'id'=>'ID'            
            ,'type'=>'类型'
            ,'ip'=>'IP'
            ,'host'=>'主机地址'
            ,'url'=>'请求地址'
            ,'username'=>'用户名'
            ,'userId'=>'用户ID'
            ,'method'=>'请求方式'
            ,'userAgent'=>'用户代理'
            ,'referer'=>'来源'
        ];
    }

    /**
     * Summary of listApi
     * 日志列表接口
     * @return void
     */
    public function listApi()
    {
        $data = $this->log->logByPage();
        $data['searchOption'] = "任意内容";// 搜索选项提示
        $this->response->json($data);
    }

    /**
     * Summary of tableHeadDataApi
     * 日志列表表头数据接口
     * @return void
     */
    public function tableHeadDataApi()
    {
        $data = [
            'code' => 0
            ,'msg' => 'success'
            ,'tableComment' => '日志列表'// 表格注释
            ,'tableFiledComment' => $this->fieldComments];
        $this->response->json($data);
    }

    /**
     * Summary of showApi
     * 日志详情接口
     * @return void
     */
    public function showApi()
    {
        $field = $this->fieldComments;
        $id = Url::getId();
        $data = $this->log->logShow($id);

        $data = [
            'code' => 0,
            'msg' => 'success',
            'data' => $data ?? [], // 确保 data 不为空
            'field' => $field// 确保 field 不为空
        ];

        $this->response->json($data);
    }

    /**
     * Summary of delete
     * 删除日志接口
     * @return void
     */
    public function delete()
    {
        $id = Url::getId();

        if($this->log->logDelete($id))
        {
            $this->response->json(['code' => 0,'msg' => '删除成功']);
        }else{
            $this->response->json(['code' => 1,'msg' => '删除失败']);
        }
    }

    /**
     * Summary of clear
     * 清空日志接口
     * @return void
     */
    public function clear()
    {
        if($this->log->clearLog())
        {
            $this->response->json(['code' => 0,'msg' => '清空成功']);
        }else{
            $this->response->json(['code' => 1,'msg' => '清空失败']);
        }
    }

    public function download()
    {
        $this->log->downloadLog();
    }
}