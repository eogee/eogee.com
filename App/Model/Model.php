<?php
namespace Model;

use Helper\Session;
use Helper\Url;
use App\Verify\Verify;
use Model\Database;
/**
 * Summary of Model
 * 所有模型的基类及助手函数
 * @author eogee.com
 * @version 1.0.0
 * @bugContacts: You can contact us by email:eogee@qq.com or QQ: 3886370035
 * @联系我们: 邮箱:eogee@qq.com 或 QQ: 3886370035
 */
class Model{
    /**
     * Summary of getTableComment
     * 获取数据表注释(模型中文名称)
     */
    public static function getTableComment($table = null)
    {
        if(empty($table)){
            $table = Url::getTable();
        }
        return Database::tableComment($table)[0]['TABLE_COMMENT'];
    }
    /**
     * Summary of getTableFieldComment
     * 获取数据表字段注释（字段中文名称）
     */
    public static function getTableFieldComment($table = null)
    {
        if(empty($table)){
            $table = Url::getTable();
        }
        $colComment = Database::columnComment($table);#获取数据表中的字段注释
        $fileds = [];
        for($i = 0 ; $i<count($colComment); $i++){
            $fileds[$colComment[$i]['COLUMN_NAME']] = $colComment[$i]['COLUMN_COMMENT'];#将字段名和注释转化为数组
        }
        return $fileds;
    }
    /**
     * Summary of columnIsnullable
     * 获取数据表字段是否为空(用于编辑数据时的非空判断)
     */
    public static function columnIsnullable($table = null)
    {
        if(empty($table)){
            $table = Url::getTable();
        }
        $columnIsnullable = Database::columnIsnullable($table);#获取数据表中字段是否为空
        $nullable = [];
        for($i = 0 ; $i<count($columnIsnullable); $i++){
            $nullable[$columnIsnullable[$i]['COLUMN_NAME']] = $columnIsnullable[$i]['IS_NULLABLE'];#将字段名和是否为空转化为数组
        }
        return $nullable;
    }
    /**
     * Summary of responce
     * 响应数据（layui数据表格返回格式）
     */
    public static function responce($data)
    {
        if(!isset($data['searchOption'])){
            $data['searchOption'] = '名称';
        }
        $arr = [
            'code' => 0
            ,'msg' => 'success'
            ,'count' => $data['count']
            ,'data' => $data['data']
            ,'searchOption' => $data['searchOption']
        ];
        header('Content-Type: application/json');
        echo json_encode($arr);
    }
    /**
     * Summary of errorResponce
     * 错误响应数据
     */
    public static function errorResponce($msg,$code = 1)
    {
        $arr = [
            'code' => $code
            ,'msg' => $msg
        ];
        header('Content-Type: application/json');
        echo json_encode($arr);
    }
    /**
     * Summary of listApi
     * 数据表格api接口
     */
    public static function listApi($table = null,$field = null,$page = 1,$limit = 10)    
    {
        if(empty($table)){ //如果没有传入数据表名则获取当前模型的表名
            $table = Url::getTable();
        }
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
        if(empty($field)){
            if(Database::hasCol('name',$table)){
                $field = 'name';
            }else{
                $field = 'id';
            }
        }
        if(isset($_GET['parentId'])){
            $parentId = $_GET['parentId'];
            $offset = ceil($page-1)*$limit;
            if(Database::hasDeletedAt($table)){ // 判断是否有deleted_at字段
                $data['data'] = Database::select($table,'where deleted_at is null and parentId = '.$parentId,"limit $offset,$limit");
                $dataCount = count(Database::select($table,'where deleted_at is null and parentId = '.$parentId));
            }else{
                $data['data'] = Database::select($table,'parentId = '.$parentId,"limit $offset,$limit");
                $dataCount = count(Database::select($table,'where parentId = '.$parentId));
            }
            $data['count'] = $dataCount;
            $data['searchOption'] = self::searchOption($field);
            self::responce($data);
        }else{
            if(isset($_GET['search']) and $_GET['search'] != null){//如果有搜索参数则进行搜索
                self::search($table,$page,$limit,$_GET['search'],$field);
            }else{
                $offset = ceil($page-1)*$limit;
                if(Database::hasDeletedAt($table)){ // 判断是否有deleted_at字段
                    $data['data'] = Database::select($table,'where deleted_at is null',"limit $offset,$limit");
                    $dataCount = count(Database::select($table,'where deleted_at is null'));
                }else{
                    $data['data'] = Database::select($table,'',"limit $offset,$limit");
                    $dataCount = count(Database::select($table));
                }
                $data['count'] = $dataCount;
                $data['searchOption'] = self::searchOption($field);
                self::responce($data);
            }
        }
    }
    /**
     * Summary of recycleApi
     * 回收站数据表格api接口
     */
    public static function recycleApi($table = null,$field = null,$page = 1,$limit = 10)
    {
        if(empty($table)){
            $table = Url::getTable();
        }
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        if(isset($_GET['limit'])){
            $limit = $_GET['limit'];
        }
        if(empty($field)){
            if(Database::hasCol('name',$table)){
                $field = 'name';
            }else{
                $field = 'id';
            }
        }
        if(isset($_GET['search']) and $_GET['search'] != null){
            self::searchRecycle($table,$page,$limit,$_GET['search'],$field);
        }else{
            $offset = ceil($page-1)*$limit;
            $data['data'] = Database::select($table,'where deleted_at is not null',"limit $offset,$limit");
            $dataCount = count(Database::select($table,'where deleted_at is not null'));
            $data['count'] = $dataCount;
            $data['searchOption'] = self::searchOption($field);
            self::responce($data);
        }
    }
    /**
     * Summary of search
     * 列表搜索 默认搜索字段为name
     */
    public static function search($table,$page,$limit,$search,$field)
    {
        $offset = ceil($page-1)*$limit;
        if(Database::hasDeletedAt($table)){ // 判断是否有deleted_at字段
            $data['data'] = Database::select($table,"where concat(".$field.") like '%".$search."%' and deleted_at is null","limit $offset,$limit");
            $dataCount = count(Database::select($table,"where concat(".$field.") like '%".$search."%' and deleted_at is null"));
        }else{
            $data['data'] = Database::select($table,"where concat(".$field.") like '%".$search."%'","limit $offset,$limit");
            $dataCount = count(Database::select($table,"where concat(".$field.") like '%".$search."%'"));
        }
        $data['count'] = $dataCount;
        self::responce($data);
    }
    /**
     * Summary of searchRecycle
     * 回收站搜索 默认搜索字段为name
     */
    public static function searchRecycle($table,$page,$limit,$search,$field)
    {
        $offset = ceil($page-1)*$limit;
        $data['data'] = Database::select($table,"where concat(".$field.") like '%".$search."%' and deleted_at is not null","limit $offset,$limit");
        $dataCount = count(Database::select($table,"where concat(".$field.") like '%".$search."%' and deleted_at is not null"));     
        $data['count'] = $dataCount;
        self::responce($data);
    }
    /**
     * Summary of searchOption
     * 获取搜索提示信息
     */
    public static function searchOption($field)
    {
        $option = explode(',',$field);
        foreach($option as $key => $value){
            $option[$key] = self::getTableFieldComment(Url::getTable())[$value];
        }
        return implode('、',$option);
    }
    
    /**
     * Summary of insert
     * 插入数据
     */
    public static function insert()
    {
        Verify::crsfVerify();
        if(isset($_POST['file'])){
            unset($_POST['file']);
        }
        Database::insert(Url::getTable(),$_POST);
    }
    /**
    * Summary of edit
    * 更新数据
    */
    public static function edit($table = null)
    {
        Verify::crsfVerify();
        if(isset($_POST['file'])){
            unset($_POST['file']);
        }
        $id = $_POST['id'];
        if(empty($table)){
            $table = Url::getTable();
        }
        Database::update($table,$_POST,"where id = $id");
    }
    /**
     * Summary of fileUploadApi
     * 文件上传api接口
     */
    public static function fileUploadApi($table = null,$fileName = null,$dir = "Resource/pic/",$id = null)
    {
        $id = Url::getId();
        if(empty($id)){
            $id = 1;
        }
        if(empty($table)){
            $table = Url::getTable();
        }
        if(empty($fileName)){
            $fileName = $_POST['fileName'];
        }
        if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = $dir;#上传目标目录
            $tmpName = $_FILES['file']['tmp_name'];#原文件地址
            $name = $_FILES['file']['name'];
            $oldFileStr = Database::select($table,"where id = $id")[0][$fileName];
            $oldFile = ltrim($oldFileStr, '/'); #去除字符串开头的所有'/'

            if($oldFile !== null and file_exists($oldFile)){
                unlink($oldFile);#删除现有文件
            }
            move_uploaded_file($tmpName, $uploadDir.$name);
            $code = 0;
            $msg = "上传成功！";
            $data = [
                $fileName => '/'.$uploadDir.$name
            ];
            Database::update($table,$data,"where id = $id");
        } else {
            $code = 100;
            $msg = "上传失败！";
        }
        $arr = [
            'code' => $code
            ,'msg' => $msg
        ];
        header('Content-Type: application/json');
        // 输出JSON格式的响应
        echo json_encode($arr);
    }
    /**
     * Summary of updateApi
     * 新增/编辑数据api接口
     */
    public static function updateApi()
    {
        $id = Url::getId();
        $data = self::show();
        $nullable = self::columnIsnullable();
        if(empty($id)){
            $data['data'] = [];
        }
        $arr = [
            'code' => 0
            ,'msg' => 'success'
            ,'data' => $data['data']
            ,'field' => $data['field']
            ,'nullable' => $nullable
            ,'csrf_token' => $_SESSION['csrf_token']
            ,'enter' => $_SESSION['username']
            ,'enterId' => Session::getUserId()
        ];
        header('Content-Type: application/json');
        echo json_encode($arr);
    }
    /**
     * Summary of show
     * 显示详情
     */
    public static function show($table = null,$id = null)
    {
        if(empty($table)){
            $table = Url::getTable();
        }
        if(empty($id)){
            $id = Url::getId();
        }
        if(empty($id)){//如果没有id则获取第一条数据
            $data['data'] = Database::select($table,"","limit 1")[0];
        }else{
            $data['data'] = Database::select($table,"where id = $id")[0];
        }
        $data['field'] = self::getTableFieldComment($table);
        return $data;
    }
    /**
     * Summary of showApi
     * 显示详情api接口
     */
    public static function showApi()
    {
        $data = self::show();
        $arr = [
            'code' => 0
            ,'msg' => 'success'
            ,'data' => $data['data']
            ,'field' => $data['field']
        ];
        header('Content-Type: application/json');
        echo json_encode($arr);
    }
    /**
     * Summary of showAll
     * 显示列表数据及子级数据
     */
    public static function showAll($table = null,$id = null,$sort = null,$where = null,$childTable = null,$parentKey = null){
        if(empty($table)){
            $table = Url::getTable();
        }
        if(empty($where)){
            if(empty($sort)){
                if(Database::hasDeletedAt($table)){
                    if(empty($id)){
                        $data = Database::select($table,"where deleted_at is null");
                    }else{
                        $data = Database::select($table,"where id = $id and deleted_at is null");
                    }
                }else{
                    if(empty($id)){
                        $data = Database::select($table);
                    }else{
                        $data = Database::select($table,"where id = $id");
                    }
                }
            }else{
                if(Database::hasDeletedAt($table)){
                    if(empty($id)){
                        $data = Database::selectOrder($table,$sort,"where deleted_at is null");
                    }else{
                        $data = Database::selectOrder($table,$sort,"where id = $id and deleted_at is null");
                    }
                }else{
                    if(empty($id)){
                        $data = Database::selectOrder($table,$sort);
                    }else{
                        $data = Database::selectOrder($table,$sort,"where id = $id");
                    }
                }
            }
        }else{
            if(empty($sort)){
                if(Database::hasDeletedAt($table)){
                    if(empty($id)){
                        $data = Database::select($table,"$where and deleted_at is null");
                    }else{
                        $data = Database::select($table,"$where and id = $id and deleted_at is null");
                    }
                }else{
                    if(empty($id)){
                        $data = Database::select($table,"$where");
                    }else{
                        $data = Database::select($table,"$where and id = $id");
                    }
                }
            }else{
                if(Database::hasDeletedAt($table)){
                    if(empty($id)){
                        $data = Database::selectOrder($table,$sort,"$where and deleted_at is null");
                    }else{
                        $data = Database::selectOrder($table,$sort,"$where and id = $id and deleted_at is null");
                    }
                }else{
                    if(empty($id)){
                        $data = Database::selectOrder($table,$sort,"$where");
                    }else{
                        $data = Database::selectOrder($table,$sort,"$where and id = $id");
                    }
                }
            }
        }
        if(!empty($childTable)){
            if(empty($parentKey)){
                $parentKey = 'parentId';
            }
            foreach($data as $key => $value){
                if(Database::hasDeletedAt($childTable)){
                    $data[$key]['childData'] = Database::selectOrder($childTable,$sort,'where '.$parentKey.' = '.$value['id'] .' and deleted_at is null');
                }else{
                    $data[$key]['childData'] = Database::selectOrder($childTable,$sort,'where '.$parentKey.' = '.$value['id']);
                }
            }
        }
        
        return $data;
    }
    /**
     * Summary of showAllWithChild
     * 显示详情及子级数据
     */
    public static function showAllWithChild($table = null,$id = null,$childTable = null,$parentKey = null)
    {
        if(empty($table)){
            $table = Url::getTable();
        }
        if(empty($id)){
            $id = url::getId();
        }
        if(Database::hasDeletedAt($table)){
            $data['data'] = Database::select($table,"where id = $id and deleted_at is null");
        }else{
            $data['data'] = Database::select($table,"where id = $id");
        }
        if(empty($parentKey)){
            $parentId = 'id';
        }
        $parentId = $data['data'][0][$parentId];
        $data['childData'] = Database::selectOrder($childTable,"sort","where parentId = $parentId");
        return $data;
    }
    /**
     * Summary of deleteSoft
     * 软删除
     */
    public static function deleteSoft()
    {
        $id = url::getId();
        $data = [
            "deleted_at" => date('Y-m-d H:i:s')
        ];
        Database::update(Url::getTable(),$data,"where id = $id");
    }
    /**
     * Summary of deleteSoftBatch
     * 批量软删除
     */
    public static function deleteSoftBatch()
    {
        $ids = $_POST['batchId'];
        $data = [
            "deleted_at" => date('Y-m-d H:i:s')
        ];
        return Database::update(Url::getTable(),$data,"where id IN ($ids)");
    }
    /**
     * Summary of delete
     * 彻底删除
     */
    public static function delete()
    {
        $id = Url::getId();
        Database::delete(Url::getTable(),"where id = $id");
    }
    /**
     * Summary of deleteBatch
     * 批量删除
     */
    public static function deleteBatch()
    {
        $ids = $_POST['batchId'];
        Database::delete(Url::getTable(),"where id IN ($ids)");
    }
    /**
     * Summary of restore
     * 还原数据
     */
    public static function restore()
    {
        $id = Url::getId();
        Database::deleteDate(Url::getTable(),"where id = $id");
    }
    /**
     * Summary of restoreBatch
     * 批量还原数据
     */
    public static function restoreBatch()
    {
        $ids = $_POST['batchId'];
        return Database::deleteDate(Url::getTable(),"where id IN ($ids)");
    }
}