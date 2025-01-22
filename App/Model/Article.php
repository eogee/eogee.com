<?php

namespace App\Model;

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
}
