<?php

namespace App\Http\Controller;

use Helper\View;
use Helper\Url;
use Helper\Window;
use App\Model\Model;
use App\Model\Log;

/**
 * Summary of BasicController
 * 基础控制器
 * @author <eogee.com> <<eogee@qq.com>>
 */
class BasicController{
    /**
     * Summary of headData
     * 前台-获取头部数据
     */
    public static function headData()
    {
        Log::insert();
        if(CONFIG['app']['developer_mode']){
            $indexUrl = '/';
        }else{
            $indexUrl = Model::show('basicInfo',1)['data']['indexUrl'];
        }
        if(Url::getTable() != null and Url::getId() != null){
            $title = Model::show()['data']['title']."-";
            $keywords = Model::show()['data']['keywords'];
            $description = Model::show()['data']['description'];
        }elseif(Url::getTable() != null){
            $title = null;
            $keywords = Model::show('',1)['data']['keywords'];
            $description = Model::show('',1)['data']['description'];
        }else{
            $title = null;
            $keywords = Model::show('basicInfo',1)['data']['keywords'];
            $description = Model::show('basicInfo',1)['data']['description'];
        };
        return  [
            'title' => $title.Model::show('basicInfo',1)['data']['title']
            ,'keywords' => $keywords
            ,'description' =>  $description
            ,'titleIconImage' => Model::show('basicInfo',1)['data']['titleIcon']
            ,'logo' => [
                'image' => Model::show('basicInfo',1)['data']['logoImage']
                ,'alt'  => Model::show('basicInfo',1)['data']['logoAlt']
            ]
            ,'indexUrl' => $indexUrl
            ,'nav' => Model::showAll('contentParent','','sort','','content')
            ,'newsTitle' => Model::show('news',1)['data']['title']
            ,'navTool' => [
                'name' => Model::show('basicInfo',1)['data']['navToolName']
                ,'url' => Model::show('basicInfo',1)['data']['navToolUrl']
            ]
            ,'singlePageName' => Model::show('basicInfo',1)['data']['singlePageName']
            ,'singlePage' => Model::showAll('singlePage','','sort',"where inNav = 1")
            ,'sponsor' => Model::showAll('footUrl','','sort',"where type = '赞助商'")
            ,'friendUrl' => Model::showAll('footUrl','','sort',"where type = '友情链接'")
            ,'internal' => Model::showAll('footUrl','','sort',"where type = '内部链接'")
            ,'copyright' => Model::show('basicInfo',1)['data']['copyright']
            ,'siteName' => Model::show('basicInfo',1)['data']['siteName']
            ,'recordCode' => Model::show('basicInfo',1)['data']['recordCode']
        ];
    }
    /**
     * Summary of limit
     * 后台-权限限制
     */
    public static function limit()
    {
        if(!isset($_SESSION['username'])){
            Window::redirect('/auth/login');//判断是否登录
            die();
        }
    }
    /**
     * Summary of detail
     * 前台-详情页-渲染页面
     */
    public static function detail()
    {
        $indexData = self::headData();//获取前台头部数据        
        $data = Model::showAllWithChild('','','content');
        $data = [
            'indexData' => $indexData
            ,'data' => $data
        ];
        View::view('/index/detail',$data);
    }
    /**
     * Summary of detailChild
     * 前台-详情页-渲染页面-子级
     */
    public static function detailChild()
    {
        $indexData = self::headData();//获取前台头部数据
        $data = Model::show();
        $data = [
            'indexData' => $indexData
            ,'data' => $data
        ];
        View::view('/index/detailChild',$data);
    }
    /**
     * Summary of tableHeadDataApi
     * 后台-获取表头数据-api接口
     */
    public static function tableHeadDataApi()
    {
        $arr = [
            'code' => 0
            ,'msg' => 'success'
            ,'tableComment' => Model::getTableComment()
            ,'tableFiledComment' => Model::getTableFieldComment()
        ];
        header('Content-Type: application/json');
        echo json_encode($arr);
    }
    /**
     * Summary of index
     * 前台-模块首页-渲染页面
     */
    public static function index()
    {
        $indexData = self::headData();
        $data = Model::show();
        $data = [
            'indexData' => $indexData
            ,'data' => $data
        ];
        View::view('/index/'.Url::getTable(),$data);
    }
    /**
     * Summary of list
     * 后台-列表页-渲染页面
     */
    public static function list()
    {
        self::limit();
        View::view('/admin/'.Url::getTable().'/list');
    }
    /**
     * Summary of recycle
     * 后台-回收站-渲染页面
     */
    public static function recycle()
    {
        self::limit();
        View::view('/admin/'.Url::getTable().'/list');      
    }
    /**
     * Summary of listApi
     * 后台-列表api接口
     */
    public static function listApi()
    {
        Model::listApi();
    }
    /**
     * Summary of recycleApi
     * 后台-回收站api接口
     */
    public static function recycleApi()
    {
        Model::recycleApi();
    }
    /**
     * Summary of show
     * 后台-查看详情-渲染页面
     */
    public static function show()
    {
        self::limit();
        View::view('/admin/show');
    }
    /**
     * Summary of showApi
     * 后台-查看详情-api接口
     */
    public static function showApi()
    {
        Model::showApi();
    }
    /**
     * Summary of insert
     * 后台-新增-渲染页面-新增数据
     */
    public static function insert()
    {
        self::limit();
        View::view('/admin/'.Url::getTable().'/update');   
        if(isset($_POST) and !empty($_POST)){
            Model::insert();
        }
    }
    /**
     * Summary of edit
     * 后台-编辑-渲染页面-编辑数据
     */
    public static function edit()
    {
        self::limit();
        $id = Url::getId();
        if(isset($id)){
            View::view('/admin/'.Url::getTable().'/update');
        }else{
            Model::edit();
        }
    }
    /**
     * Summary of fileUploadApi
     * 文件上传-api接口
     */
    public static function fileUploadApi()
    {
        Model::fileUploadApi();
    }
    /**
     * Summary of updateApi
     * 更新数据-api接口-获取数据及字段信息
     */
    public static function updateApi()
    {
        Model::updateApi();
    }
    /**
     * Summary of delete
     * 删除
     */
    public static function delete()
    {
        Model::delete();
    }
    /**
     * Summary of deleteBatch
     * 批量删除
     */
    public static function deleteBatch()
    {        
        Model::deleteBatch();
    }
    /**
     * Summary of deleteSoft
     * 软删除
     */
    public static function deleteSoft()
    {
        Model::deleteSoft();
    }
    /**
     * Summary of deleteSoftBatch
     * 批量软删除
     */
    public static function deleteSoftBatch()
    {
        Model::deleteSoftBatch();
    }
    /**
     * Summary of restore
     * 还原
     */
    public static function restore()
    {
        Model::restore();
    }
    /**
     * Summary of restoreBatch
     * 批量还原
     */
    public static function restoreBatch()
    {
        Model::restoreBatch();
    }
}