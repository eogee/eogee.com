<?php

namespace Easy\Controller;

use Easy\View\View;
use Easy\File\File;
use Easy\Model\Base as Model;
use Easy\Model\Log;
use Easy\Verify\Verify;
use Easy\Request\Request;
use Easy\Response\Response;
use Helper\Url;

/**
 * Summary of BasicController
 * 基础控制器
 * @author Eogee
 * @email eogee@qq.com 
 */
class Controller{
    protected $model;//模型类
    protected $response;//响应类
    protected $table;//数据表名
    protected $id;//数据表主键
    protected $Log;//日志类

    public function __construct(){
        $this->model = new Model;
        $this->response = new Response;//实例化响应类        
        $this->Log = new Log;//实例化响应类
        $this->table = Url::getTable();
        $this->id = Url::getId();
    }

    /**
     * Summary of headData
     * 前台-获取头部数据
     * @return array
     */
    public function headData()
    {
        $this->Log->insert();
        
        // 根据开发模式选择索引 URL
        $indexUrl = CONFIG['app']['developer_mode'] ? '/' : $this->model->show('basicInfo', 1)['data']['indexUrl'];
    
        // 获取基本信息
        $basicInfo = $this->model->show('basicInfo', 1)['data'];
        
        // 初始化 title, keywords 和 description
        $title = $keywords = $description = null;
    
        // 判断 URL 中的表和 ID
        if ($this->table !== null && $this->id !== null) {
            $data = $this->model->show(); // 获取当前模型数据
            $title = $data['data']['title'] . "-";
            $keywords = $data['data']['keywords'] ?? '';
            $description = $data['data']['description'] ?? '';
        } elseif ($this->table !== null) {
            $title = null;
            $keywords = $basicInfo['keywords'] ?? '';
            $description = $basicInfo['description'] ?? '';
        } else {
            $title = null;
            $keywords = $basicInfo['keywords'] ?? '';
            $description = $basicInfo['description'] ?? '';
        }
        
        return [
            'title' => $title . $basicInfo['title'],
            'keywords' => $keywords,
            'description' => $description,
            'titleIconImage' => $basicInfo['titleIcon'],
            'logo' => [
                'image' => $basicInfo['logoImage'],
                'alt' => $basicInfo['logoAlt']
            ],
            'indexUrl' => $indexUrl,
            'nav' => $this->model->showAll('contentParent', '', 'sort', '', 'content'),
            'newsTitle' => $this->model->show('news', 1)['data']['title'] ?? '',
            'navTool' => [
                'name' => $basicInfo['navToolName'] ?? '',
                'url' => $basicInfo['navToolUrl'] ?? ''
            ],
            'singlePageName' => $basicInfo['singlePageName'] ?? '',
            'singlePage' => $this->model->showAll('singlePage', '', 'sort', "inNav = 1"),
            'sponsor' => $this->model->showAll('footUrl', '', 'sort', "type = '赞助商'"),
            'friendUrl' => $this->model->showAll('footUrl', '', 'sort', "type = '友情链接'"),
            'internal' => $this->model->showAll('footUrl', '', 'sort', "type = '内部链接'"),
            'copyright' => $basicInfo['copyright'] ?? '',
            'siteName' => $basicInfo['siteName'] ?? '',
            'recordCode' => $basicInfo['recordCode'] ?? '',
        ];
    }
    /**
     * Summary of detail
     * 前台-详情页-渲染页面
     * @return void
     */
    public function detail()
    {
        $indexData = $this->headData();//获取前台头部数据
        $data = $this->model->showAllWithChild('','','content');
        $data = [
            'indexData' => $indexData
            ,'data' => $data
        ];
        View::view('/index/detail',$data);
    }
    /**
     * Summary of detailChild
     * 前台-详情页-渲染页面-子级
     * @return void
     */
    public function detailChild()
    {
        $indexData = $this->headData();//获取前台头部数据
        $data = $this->model->show();
        $data = [
            'indexData' => $indexData
            ,'data' => $data
        ];
        View::view('/index/detailChild',$data);
    }
    /**
     * Summary of tableHeadDataApi
     * 后台-获取表头数据-api接口
     * @return void
     */
    public function tableHeadDataApi()
    {        
        $data = [
            'code' => 0
            ,'msg' => 'success'
            ,'tableComment' => $this->model->getTableComment()
            ,'tableFiledComment' => $this->model->getTableFieldComment()
        ];
        //$response = new Response;
        $this->response->json($data);
    }
    /**
     * Summary of index
     * 前台-模块首页-渲染页面
     * @return void
     */
    public function index()
    {
        $indexData = $this->headData();
        $data = $this->model->show();
        $data = [
            'indexData' => $indexData
            ,'data' => $data
        ];
        View::view('/index/'.$this->table,$data);
    }
    /**
     * Summary of list
     * 后台-列表页-渲染页面
     * @return void
     */
    public function list()
    {
        Verify::adminLimit();
        View::view('/admin/'.$this->table.'/list');
    }
    /**
     * Summary of recycle
     * 后台-回收站-渲染页面
     * @return void
     */
    public function recycle()
    {
        Verify::adminLimit();
        View::view('/admin/'.$this->table.'/list');      
    }
    /**
     * Summary of listApi
     * 后台-列表api接口
     * @return void
     */
    public function listApi()
    {
        $data = $this->model->listApi();
        $this->response->json($data);
    }
    /**
     * Summary of recycleApi
     * 后台-回收站api接口
     * @return void
     */
    public function recycleApi()
    {
        $data = $this->model->recycleApi();
        $response = new Response;
        $response->json($data);
    }
    /**
     * Summary of show
     * 后台-查看详情-渲染页面
     * @return void
     */
    public function show()
    {
        Verify::adminLimit();
        View::view('/admin/show');
    }
    /**
     * Summary of showApi
     * 后台-查看详情-api接口
     * @return void
     */
    public function showApi()
    {
        $data = $this->model->showApi();
        $this->response->json($data);
    }
    /**
     * Summary of insert
     * 后台-新增-渲染页面-新增数据
     * @return void
     */
    public function insert()
    {
        Verify::adminLimit();
        View::view('/admin/'.$this->table.'/update');   
        if(isset($_POST) and !empty($_POST)){
            $this->model->insert();
        }
    }
    /**
     * Summary of edit
     * 后台-编辑-渲染页面-编辑数据
     * @return void
     */
    public function edit()
    {
        Verify::adminLimit();
        $id = $this->id;
        if(isset($id)){
            View::view('/admin/'.$this->table.'/update');
        }else{
            $this->model->edit();
        }
    }
    /**
     * Summary of fileUploadApi
     * 文件上传-api接口
     * @return void
     */
    public function fileUploadApi()
    {
        $file = new File();
        $data = $file->fileUploadApi();
        $this->response->json($data);
    }
    /**
     * Summary of updateApi
     * 更新数据-api接口-获取数据及字段信息
     * @return void
     */
    public function updateApi()
    {
        $data = $this->model->updateApi();
        $this->response->json($data);
    }
    /**
     * Summary of delete
     * 删除
     * @return void
     */
    public function delete()
    {
        $this->model->delete();
    }
    /**
     * Summary of deleteBatch
     * 批量删除
     * @return void
     */
    public function deleteBatch()
    {
        $this->model->deleteBatch();
    }
    /**
     * Summary of deleteSoft
     * 软删除
     * @return void
     */
    public function deleteSoft()
    {
        $this->model->deleteSoft();
    }
    /**
     * Summary of deleteSoftBatch
     * 批量软删除
     * @return void
     */
    public function deleteSoftBatch()
    {
        $this->model->deleteSoftBatch();
    }
    /**
     * Summary of restore
     * 还原
     * @return void
     */
    public function restore()
    {
        $this->model->restore();
    }
    /**
     * Summary of restoreBatch
     * 批量还原
     * @return void
     */
    public function restoreBatch()
    {
        $this->model->restoreBatch();
    }
}