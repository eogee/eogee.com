<?php

namespace App\Model;

/**
 * 最新动态 模型
 */
class News extends Model 
{
    public function updateApi()
    {
        // 获取 ID
        $id = $this->id;
    
        // 初始化数据
        $data = $this->show();
    
        // 如果 ID 为空，返回空数据
        if (empty($id)) {
            $data['data'] = [];
        }
    
        // 获取字段是否可空
        $nullable = $this->columnIsnullable();
    
        // 构建响应数组
        return $data = [
            'code' => 0,
            'msg' => 'success',
            'data' => $data['data'] ?? [], // 使用 null 合并运算符确保不存在时返回空数组
            'field' => $data['field'] ?? [], // 使用 null 合并运算符确保不存在时返回空数组
            'nullable' => $nullable,
            'option' => $this->db->selectCol('content', 'id, title', 'deleted_at IS NULL'), // 获取内容选项
            'csrf_token' => $_SESSION['csrf_token'] ?? '', // 使用默认值防止未定义索引
            'enter' => $_SESSION['username'] ?? 'Guest', // 使用默认值防止未定义索引
            'enterId' => $this->session->getUserId() ?? null // 确保返回有效的用户 ID
        ];
    }
    public function showAll($table = null, $id = null, $sort = null, $where = null, $childTable = null, $parentKey = null)
    {
        // 如果未提供表名，默认为 'news'
        $table = $table ?? 'news';
        
        // 获取基本信息
        $data['info'] = $this->show($table);

        // 查询内容父级数据
        $data['data'] = $this->db->selectOrder('contentParent', 'sort', "WHERE isNews = 1 AND deleted_at IS NULL");
        
        // 处理每个父级条目以查找其子级
        foreach ($data['data'] as $key => $value) {
            $parentId = intval($value['id']); // 将 id 转换为整数防止 SQL 注入
            $data['data'][$key]['childData'] = $this->db->selectOrder(
                'content', 
                'sort', 
                "WHERE parentId = $parentId AND deleted_at IS NULL AND isNews = 1"
            );
        }

        return $data; // 返回所有数据
    }

}
