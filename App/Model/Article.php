<?php

namespace App\Model;

use Easy\Verify\Verify;
use Helper\Url;

class Article extends Model
{
    public function updateApi()
    {    
        // 获取相关数据
        $data = $this->show(); // 获取数据
        $nullable = $this->columnIsnullable(); // 获取字段是否可空
        $options = $this->db->selectCol('category', "id, name"); // 获取分类选项
        $nickname = $this->db->select('user',  "where id={$this->session->getUserId()}")[0]['nickname']; // 获取用户昵称
    
        // 构建响应数组
        return $data = [
            'code' => 0,
            'msg' => 'success',
            'data' => !empty($data['data']) ? $data['data'] : [], // 确保数据存在
            'field' => !empty($data['field']) ? $data['field'] : [], // 确保字段存在
            'nullable' => $nullable,
            'options' => !empty($options) ? $options : [], // 确保选项存在
            'csrf_token' => $_SESSION['csrf_token'] ?? '', // 确保 CSRF Token 存在
            'authorUsername' => $_SESSION['username'] ?? 'Guest', // 设置作者名称为 'Guest'
            'authorNickname' => $nickname ?? null, // 设置作者名称为 'Guest'
            'authorId' => $this->session->getUserId() ?? null // 确保返回有效的用户 ID
        ];
    }
    public function detailApi()
    {
        // 获取相关数据
        $data = $this->show()['data']['content']; // 获取数据

        // 构建响应数组
        return  !empty($data) ? $data : null; // 确保数据存在
    }
    public function insert()
    {
        // 验证 CSRF Token
        Verify::crsfVerify();

        // 移除不需要的字段
        if (isset($_POST['file'])) {
            unset($_POST['file']); // 移除 file 字段，如果存在
        }        
        if (isset($_POST['editormd-image-file'])){
            unset($_POST['editormd-image-file']); // 移除 editormd-image-file 字段，如果存在
        }

        // 获取分类ID获取分类名称
        $categoryName = $this->db->select('category', "where id={$_POST['categoryId']}")[0]['name'];
        $_POST['categoryName'] = $categoryName; // 增加分类名称字段

        // 验证 POST 数据是否有效
        if (empty($_POST) || !is_array($_POST)) {
            return "没有有效的数据进行插入"; // 返回错误信息
        }

        // 执行插入操作并返回结果
        return $this->db->insert(Url::getTable(), $_POST);
    }

    /**
     * Summary of edit
     * 更新数据
     * @param string $table 数据表名
     * @return string 更新结果信息
     */
    public function edit($table = null)
    {
        // 验证 CSRF Token
        Verify::crsfVerify();

        // 移除不需要的字段
        if (isset($_POST['file'])) {
            unset($_POST['file']); // 移除 file 字段，如果存在
        }
        if (isset($_POST['editormd-image-file'])){
            unset($_POST['editormd-image-file']); // 移除 editormd-image-file 字段，如果存在
        }

        // 验证 ID 是否存在
        if (empty($_POST['id'])) {
            return "ID 不能为空"; // 返回错误信息
        }
        
        $id = intval($_POST['id']); // 确保 ID 是整数

        // 获取表名
        if (empty($table)) {
            $table = $this->table;
        }

        // 获取分类ID获取分类名称
        $categoryName = $this->db->select('category', "where id={$_POST['categoryId']}")[0]['name'];
        $_POST['categoryName'] = $categoryName; // 增加分类名称字段

        // 执行更新操作
        $result = $this->db->update($table, $_POST, "WHERE id = $id");

        // 处理更新结果
        if (is_string($result)) {
            return false; // 如果返回的是字符串，则为错误信息
        }
        
        return true; // 返回成功信息
        
    }
}
