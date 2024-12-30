<?php
namespace Model;
/**
 * 最新动态 模型
 */
class News extends Model 
{
    public static function updateApi()
    {
        $id = self::getId();
        $data = self::show();
        if(empty($id)){
            $data['data'] = [];
        }
        $nullable = self::columnIsnullable();
        $arr = [
            'code' => 0
            ,'msg' => 'success'
            ,'data' => $data['data']
            ,'field' => $data['field']
            ,'nullable' => $nullable
            ,'option' => Database::selectCol('content','id,title','deleted_at is null')
            ,'csrf_token' => $_SESSION['csrf_token']
            ,'enter' => $_SESSION['username']
            ,'enterId' => self::getUserId()
        ];
        header('Content-Type: application/json');
        echo json_encode($arr);
    }
    public static function showAll($table = null,$id = null,$sort = null,$where = null,$childTable = null,$parentKey = null)
    {
        
        $data['info'] = self::show('news');
        $data['data'] = Database::selectOrder('contentParent','sort','where isNews = 1 and deleted_at is null');
        foreach($data['data'] as $key => $value){
            $data['data'][$key]['childData'] = Database::selectOrder('content','sort','where parentId = '.$value['id'] .' and deleted_at is null and isNews = 1');
        }
        return $data;
    }
}
