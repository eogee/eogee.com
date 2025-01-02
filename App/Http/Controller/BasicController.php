<?php

namespace App\Http\Controller;

use Helper\View;
use Helper\Url;
use Helper\File;
use App\Model\Model;
use App\Model\Log;
use App\Verify\Verify;
use App\Http\Request\Request;
use App\Http\Response;
use App\Http\Response\Responce;

/**
 * Summary of BasicController
 * 基础控制器
 * @author <eogee.com> <<eogee@qq.com>>
 */
class BasicController{
    /**
     * Summary of headData
     * 前台-获取头部数据
     * @return array
     */
    public static function headData()
    {
        Log::insert();
        
        // 根据开发模式选择索引 URL
        $indexUrl = CONFIG['app']['developer_mode'] ? '/' : Model::show('basicInfo', 1)['data']['indexUrl'];
    
        // 获取基本信息
        $basicInfo = Model::show('basicInfo', 1)['data'];
        
        // 初始化 title, keywords 和 description
        $title = $keywords = $description = null;
    
        // 判断 URL 中的表和 ID
        if (Url::getTable() !== null && Url::getId() !== null) {
            $data = Model::show(); // 获取当前模型数据
            $title = $data['data']['title'] . "-";
            $keywords = $data['data']['keywords'] ?? '';
            $description = $data['data']['description'] ?? '';
        } elseif (Url::getTable() !== null) {
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
            'nav' => Model::showAll('contentParent', '', 'sort', '', 'content'),
            'newsTitle' => Model::show('news', 1)['data']['title'] ?? '',
            'navTool' => [
                'name' => $basicInfo['navToolName'] ?? '',
                'url' => $basicInfo['navToolUrl'] ?? ''
            ],
            'singlePageName' => $basicInfo['singlePageName'] ?? '',
            'singlePage' => Model::showAll('singlePage', '', 'sort', "inNav = 1"),
            'sponsor' => Model::showAll('footUrl', '', 'sort', "type = '赞助商'"),
            'friendUrl' => Model::showAll('footUrl', '', 'sort', "type = '友情链接'"),
            'internal' => Model::showAll('footUrl', '', 'sort', "type = '内部链接'"),
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
     * @return void
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
     * @return void
     */
    public static function tableHeadDataApi()
    {
        $responce = [
            'code' => 0
            ,'msg' => 'success'
            ,'tableComment' => Model::getTableComment()
            ,'tableFiledComment' => Model::getTableFieldComment()
        ];
        Response::json($responce);
    }
    /**
     * Summary of index
     * 前台-模块首页-渲染页面
     * @return void
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
     * @return void
     */
    public static function list()
    {
        Verify::adminLimit();
        View::view('/admin/'.Url::getTable().'/list');
    }
    /**
     * Summary of recycle
     * 后台-回收站-渲染页面
     * @return void
     */
    public static function recycle()
    {
        Verify::adminLimit();
        View::view('/admin/'.Url::getTable().'/list');      
    }
    /**
     * Summary of listApi
     * 后台-列表api接口
     * @return void
     */
    public static function listApi()
    {
        Model::listApi();
    }
    /**
     * Summary of recycleApi
     * 后台-回收站api接口
     * @return void
     */
    public static function recycleApi()
    {
        Model::recycleApi();
    }
    /**
     * Summary of show
     * 后台-查看详情-渲染页面
     * @return void
     */
    public static function show()
    {
        Verify::adminLimit();
        View::view('/admin/show');
    }
    /**
     * Summary of showApi
     * 后台-查看详情-api接口
     * @return void
     */
    public static function showApi()
    {
        Model::showApi();
    }
    /**
     * Summary of insert
     * 后台-新增-渲染页面-新增数据
     * @return void
     */
    public static function insert()
    {
        Verify::adminLimit();
        View::view('/admin/'.Url::getTable().'/update');   
        if(isset($_POST) and !empty($_POST)){
            Model::insert();
        }
    }
    /**
     * Summary of edit
     * 后台-编辑-渲染页面-编辑数据
     * @return void
     */
    public static function edit()
    {
        Verify::adminLimit();
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
     * @return void
     */
    public static function fileUploadApi()
    {
        File::fileUploadApi();
    }
    /**
     * Summary of updateApi
     * 更新数据-api接口-获取数据及字段信息
     * @return void
     */
    public static function updateApi()
    {
        Model::updateApi();
    }
    /**
     * Summary of delete
     * 删除
     * @return void
     */
    public static function delete()
    {
        Model::delete();
    }
    /**
     * Summary of deleteBatch
     * 批量删除
     * @return void
     */
    public static function deleteBatch()
    {        
        Model::deleteBatch();
    }
    /**
     * Summary of deleteSoft
     * 软删除
     * @return void
     */
    public static function deleteSoft()
    {
        Model::deleteSoft();
    }
    /**
     * Summary of deleteSoftBatch
     * 批量软删除
     * @return void
     */
    public static function deleteSoftBatch()
    {
        Model::deleteSoftBatch();
    }
    /**
     * Summary of restore
     * 还原
     * @return void
     */
    public static function restore()
    {
        Model::restore();
    }
    /**
     * Summary of restoreBatch
     * 批量还原
     * @return void
     */
    public static function restoreBatch()
    {
        Model::restoreBatch();
    }
}