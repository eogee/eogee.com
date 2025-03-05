<?php

namespace App\Model;

use Helper\Url;

class SmallStove extends Model
{
    public function submit()
    {    
        // 移除不需要的字段
        if (isset($_POST['file'])) {
            unset($_POST['file']); // 移除 file 字段，如果存在
        }        
        if (isset($_POST['editormd-image-file'])){
            unset($_POST['editormd-image-file']); // 移除 editormd-image-file 字段，如果存在
        }

        // 验证 POST 数据是否有效
        if (empty($_POST) || !is_array($_POST)) {
            return "没有有效的数据进行插入"; // 返回错误信息
        }

        // 执行插入操作并返回结果
        return $this->db->insert(Url::getTable(), $_POST);
    }
}
