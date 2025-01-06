<?php

namespace Easy\Model;

use Easy\Session\Session;
use Easy\Database\Database;
use Easy\Verify\Verify;
use Helper\Url;

/**
 * Summary of Model
 * 所有模型的基类
 * @author Eogee
 * @email eogee@qq.com 
 */
class Base{
    protected $db;//数据库连接资源
    protected $table;//数据表名
    protected $id;//数据表主键
    protected $session;//session对象

    public function __construct()
    {
        $this->db = Database::getInstance();//获取数据库连接资源
        $this->session = new Session;//获取数据库连接资源
        $this->table =  Url::getTable(); // 获取数据表名
        $this->id =  Url::getId(); // 获取数据表主键
    }
    /**
     * Summary of getTableComment
     * 获取数据表注释(模型中文名称)
     * @param string $table 数据表名
     * @return string 数据表注释
     */
    public function getTableComment($table = null)
    {
        // 如果表名为空，则尝试从 URL 获取表名
        if (empty($table)) {
            $table = $this->table;
        }
    
        // 确保表名有效
        if (empty($table)) {
            return "表名不能为空"; // 提示表名不能为空
        }
    
        // 获取表注释
        $result = $this->db->tableComment($table);
    
        // 检查返回结果是否有效
        if (is_array($result) && !empty($result) && isset($result[0]['TABLE_COMMENT'])) {
            return $result[0]['TABLE_COMMENT']; // 返回有效的表注释
        }
    
        return "未找到表注释(模型中文名称)"; // 返回未找到备注的提示
    }    
    /**
     * Summary of getTableFieldComment
     * 获取数据表字段注释（字段中文名称）
     * @param string $table 数据表名
     * @return array|string 数据表字段注释
     */
    public function getTableFieldComment($table = null)
    {
        // 如果未提供表名，则尝试从 URL 获取
        if (empty($table)) {
            $table = $this->table;
        }

        // 确保表名有效
        if (empty($table)) {
            return "表名不能为空"; // 返回错误信息
        }

        // 获取字段注释
        $colComments = $this->db->columnComment($table); // 获取数据表中的字段注释

        // 初始化字段注释数组
        $fields = [];
        foreach ($colComments as $col) {
            $fields[$col['COLUMN_NAME']] = $col['COLUMN_COMMENT']; // 将字段名和注释转化为数组
        }

        return $fields; // 返回字段名和注释的数组
    }
    /**
     * Summary of columnIsnullable
     * 获取数据表字段是否为空（用于编辑数据时的非空判断）
     * @param string $table 数据表名
     * @return array|string 数据表字段是否为空
     */
    public function columnIsnullable($table = null)
    {
        // 如果未提供表名，则尝试从 URL 获取
        if (empty($table)) {
            $table = $this->table;
        }

        // 确保表名有效
        if (empty($table)) {
            return "表名不能为空"; // 返回错误信息
        }

        // 获取字段是否为空的信息
        $columnNullableInfo = $this->db->columnIsnullable($table); // 获取数据表中字段是否为空

        // 初始化是否为空的字段数组
        $nullable = [];
        foreach ($columnNullableInfo as $column) {
            $nullable[$column['COLUMN_NAME']] = $column['IS_NULLABLE']; // 将字段名和是否为空转化为数组
        }

        return $nullable; // 返回字段名和其是否可为空的数组
    }
    /**
     * Summary of listApi
     * 数据表格api接口
     * @param string $table 数据表名
     * @param string $field 字段名
     * @param int $page 页码
     * @param int $limit 每页限制
     * @return array 响应数据
     */
    public function listApi($table = null, $field = null, $page = 1, $limit = 10)
    {
        // 如果没有传入数据表名，则获取当前模型的表名
        if (empty($table)) {
            $table = $this->table;
        }
    
        // 通过 GET 方法获取当前页和每页限制
        $page = isset($_GET['page']) ? intval($_GET['page']) : $page; // 确保页码为整数
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : $limit; // 确保限制为整数
    
        // 确定查询的字段
        if (empty($field)) {
            $field = $this->db->hasCol('name', $table) ? 'name' : 'id';
        }
    
        // 检查是否提供了 parentId
        if (isset($_GET['parentId'])) {
            $parentId = intval($_GET['parentId']); // 确保 parentId 为整数
            $offset = ($page - 1) * $limit;
    
            // 生成查询条件
            $where = $this->db->hasDeletedAt($table)
                ? "WHERE deleted_at IS NULL AND parentId = $parentId"
                : "WHERE parentId = $parentId";
    
            // 查询数据和计数
            $data['data'] = $this->db->select($table, $where, "LIMIT $offset, $limit");
            $dataCount = count($this->db->select($table, "WHERE deleted_at IS NULL AND parentId = $parentId"));
    
        } else {
            // 没有 parentId，进行其他查询
            $offset = ($page - 1) * $limit;
    
            if (isset($_GET['search']) && $_GET['search'] != null) {
                // 如果有搜索参数，则进行搜索
                self::search($table, $page, $limit, $_GET['search'], $field);
                die(); // 结束函数执行
            }
    
            // 检查是否有 deleted_at 字段
            $where = $this->db->hasDeletedAt($table) ? "WHERE deleted_at IS NULL" : "";
            
            // 查询数据和计数
            $data['data'] = $this->db->select($table, $where, "LIMIT $offset, $limit");
            $dataCount = count($this->db->select($table, $where));
        }
    
        // 填充数据返回格式
        $data['count'] = $dataCount;
        $data['searchOption'] = self::searchOption($field);
        // 构建响应数组
        return $data = [
            'code' => 0,
            'msg' => 'success',
            'count' => isset($data['count']) ? $data['count'] : 0, // 确保 count 存在
            'data' => $data['data'] ?? [], // 默认提供一个空数组
            'searchOption' => $data['searchOption']
        ];
    }
    /**
     * Summary of recycleApi
     * 回收站数据表格 api 接口
     * @param string $table 数据表名
     * @param string $field 字段名
     * @param int $page 页码
     * @param int $limit 每页限制
     * @return array 响应回收站数据
     */
    public function recycleApi($table = null, $field = null, $page = 1, $limit = 10)
    {
        // 如果没有传入数据表名，则获取当前模型的表名
        if (empty($table)) {
            $table = $this->table;
        }

        // 获取当前页和每页限制，确保是整数
        $page = isset($_GET['page']) ? intval($_GET['page']) : $page;
        $limit = isset($_GET['limit']) ? intval($_GET['limit']) : $limit;

        // 如果未提供字段，默认选择 'name' 或 'id'
        $field = $field ?: ($this->db->hasCol('name', $table) ? 'name' : 'id');

        // 处理搜索参数
        if (isset($_GET['search']) && trim($_GET['search']) !== '') {
            self::searchRecycle($table, $page, $limit, $_GET['search'], $field);
            die(); // 调用 searchRecycle 后退出方法，避免执行后续查询
        }

        // 计算偏移量
        $offset = max(0, ($page - 1) * $limit);

        // 查询回收站的数据
        $data['data'] = $this->db->select($table, 'WHERE deleted_at IS NOT NULL', "LIMIT $offset, $limit");
        $dataCount = count($this->db->select($table, 'WHERE deleted_at IS NOT NULL'));

        // 准备返回数据
        $data['count'] = $dataCount;
        $data['searchOption'] = $this->searchOption($field);

        // 构建响应数组
        return $data = [
            'code' => 0,
            'msg' => 'success',
            'count' => isset($data['count']) ? $data['count'] : 0, // 确保 count 存在
            'data' => $data['data'] ?? [], // 默认提供一个空数组
            'searchOption' => $data['searchOption']
        ];
    }
    /**
     * Summary of search
     * 列表搜索，默认搜索字段为 name
     * @param string $table 数据表名
     * @param int $page 页码
     * @param int $limit 每页限制
     * @param string $search 搜索内容
     * @param string $field 搜索字段名 
     * @return  响应搜索结果
     */
    public function search($table, $page, $limit, $search, $field)
    {
        // 计算偏移量
        $offset = max(0, ceil($page - 1) * $limit);

        // 验证表名和字段名
        if (empty($table) || empty($field)) {
            return "表名和字段名不能为空"; // 返回错误信息
        }

        // 确保搜索内容不是空白
        if (empty($search)) {
            return "搜索内容不能为空"; // 返回错误信息
        }

        // 安全处理字段名和搜索内容
        $table = Database::getInstance()->conn->real_escape_string($table);
        $field = Database::getInstance()->conn->real_escape_string($field);
        $search = Database::getInstance()->conn->real_escape_string($search);

        // 生成 SQL 查询
        $likeClause = "WHERE CONCAT($field) LIKE '%$search%'";
        if ($this->db->hasDeletedAt($table)) {
            $likeClause .= " AND deleted_at IS NULL"; // 检查 deleted_at 字段
        }

        // 执行查询以获取数据
        $data['data'] = $this->db->select($table, $likeClause, "LIMIT $offset, $limit");
        $dataCount = count($this->db->select($table, $likeClause)); // 获取总数

        // 准备返回数据
        $data['count'] = $dataCount;

        // 构建响应数组
        return $data = [
            'code' => 0,
            'msg' => 'success',
            'count' => isset($data['count']) ? $data['count'] : 0, // 确保 count 存在
            'data' => $data['data'] ?? [], // 默认提供一个空数组
            'searchOption' => $data['searchOption']
        ];
    }

    /**
     * Summary of searchRecycle
     * 回收站搜索 默认搜索字段为name
     * @param string $table 数据表名
     * @param int $page 页码
     * @param int $limit 每页限制
     * @param string $search 搜索内容
     * @param string $field 搜索字段名 
     * @return  响应搜索结果
     */
    public function searchRecycle($table, $page, $limit, $search, $field)
    {
        // 验证表名和字段名的有效性
        if (empty($table) || empty($field)) {
            return "表名和搜索字段不能为空"; // 返回错误信息
        }
    
        // 计算偏移量
        $offset = max(0, ceil($page - 1) * $limit);
    
        // 使用参数化查询构建 SQL 查询
        $table = Database::getInstance()->conn->real_escape_string($table);
        $field = Database::getInstance()->conn->real_escape_string($field);
        $search = Database::getInstance()->conn->real_escape_string($search);
    
        // 构建 WHERE 子句，防止 SQL 注入
        $where = "WHERE CONCAT($field) LIKE '%$search%' AND deleted_at IS NOT NULL";
    
        // 查询数据
        $data['data'] = $this->db->select($table, $where, "LIMIT $offset, $limit");
    
        // 查询总数
        $dataCount = count($this->db->select($table, $where));
    
        // 准备响应数组
        return $data = [
            'code' => 0,
            'msg' => 'success',
            'count' => $dataCount, // 保证 count 存在
            'data' => $data['data'] ?? [], // 默认提供一个空数组
            'searchOption' => $this->searchOption($field) // 假设这是可用的
        ];
    }
    
    /**
     * Summary of searchOption
     * 获取搜索提示信息
     * @param string $field 字段名
     * @return string 搜索提示信息
     */
    public function searchOption($field)
    {
        // 验证字段是否合法
        if (empty($field)) {
            return ""; // 如果没有提供字段，返回空字符串
        }

        // 将字段字符串拆分为数组
        $fields = explode(',', $field);
        $fieldComments = $this->getTableFieldComment(Url::getTable()); // 获取字段注释

        $options = [];
        foreach ($fields as $value) {
            // 适当处理存在的字段注释
            $trimmedValue = trim($value); // 去掉多余空格
            if (isset($fieldComments[$trimmedValue])) {
                $options[] = $fieldComments[$trimmedValue]; // 将注释添加到选项中
            }
        }

        // 用连接符 '、' 返回最终结果
        return implode('、', $options);
    }    
    /**
     * Summary of insert
     * 插入数据
     * @return string 插入结果信息
     */
    public function insert()
    {
        // 验证 CSRF Token
        Verify::crsfVerify();

        // 移除不需要的字段
        if (isset($_POST['file'])) {
            unset($_POST['file']); // 移除 file 字段，如果存在
        }

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

        // 验证 ID 是否存在
        if (empty($_POST['id'])) {
            return "ID 不能为空"; // 返回错误信息
        }
        
        $id = intval($_POST['id']); // 确保 ID 是整数

        // 获取表名
        if (empty($table)) {
            $table = $this->table;
        }

        // 执行更新操作
        $result = $this->db->update($table, $_POST, "WHERE id = $id");

        // 处理更新结果
        if (is_string($result)) {
            return $result; // 如果返回的是字符串，则为错误信息
        }

        return true; // 返回成功信息
    }
    /**
     * Summary of updateApi
     * 新增/编辑数据api接口
     */
    public function updateApi()
    {
        // 获取 ID
        $id = $this->id;
    
        // 验证 ID 是否存在
        if (empty($id)) {
            return  [
                'code' => 100,
                'msg' => 'ID 不能为空',
                'data' => []
            ]; // 返回错误信息
        }

        // 如果未提供表名，则获取当前模型的表名
        if (empty($table)) {
            $table = $this->table;
        }
    
        // 获取数据和可空字段信息
        $data = $this->show();
        $nullable = $this->columnIsnullable($table);
    
        // 准备响应数据
        return $data = [
            'code' => 0,
            'msg' => 'success',
            'data' => !empty($data['data']) ? $data['data'] : [], // 确保数据有效
            'field' => !empty($data['field']) ? $data['field'] : [], // 确保字段有效
            'nullable' => $nullable,
            'csrf_token' => $_SESSION['csrf_token'] ?? '', // 确保 CSRF Token 存在
            'enter' => $_SESSION['username'] ?? 'Guest', // 使用默认用户名
            'enterId' => $this->session->getUserId() ?? null // 确保返回有效的用户 ID
        ];
    }
    
    /**
     * Summary of show
     * 显示详情
     * @param string $table 数据表名
     * @param int $id 数据 ID
     * @return array 数据及字段信息
     */
    public function show($table = null, $id = null)
    {
        // 如果未提供表名，则获取当前模型的表名
        if (empty($table)) {
            $table = $this->table;
        }
    
        // 如果未提供 ID，则从 URL 获取
        if (empty($id)) {
            $id = $this->id;
        }
    
        $data = []; // 初始化数据数组
    
        // 查询数据
        if (empty($id)) { // 如果没有 ID，则获取第一条数据
            $result = $this->db->select($table, "", "LIMIT 1");
            if (!empty($result)) {
                $data['data'] = $result[0]; // 存在则获取数据
            } else {
                $data['data'] = []; // 没有数据则设为空
            }
        } else {
            $result = $this->db->select($table, "WHERE id = " . intval($id));
            if (!empty($result)) {
                $data['data'] = $result[0]; // 存在则获取数据
            } else {
                $data['data'] = []; // 没有数据则设为空
            }
        }
    
        // 获取字段注释
        $data['field'] = $this->getTableFieldComment($table);
    
        return $data; // 返回数据
    }
    
    /**
     * Summary of showApi
     * 显示详情api接口
     * @return array 响应数据
     */
    public function showApi()
    {
        // 获取数据
        $data = $this->show();
    
        // 创建响应数组
        return $data = [
            'code' => 0,
            'msg' => 'success',
            'data' => !empty($data['data']) ? $data['data'] : [], // 确保 data 不为空
            'field' => !empty($data['field']) ? $data['field'] : [] // 确保 field 不为空
        ];
    }    
    /**
     * Summary of showAll
     * 显示列表数据及子级数据
     * @param string $table 数据表名
     * @param int $id 数据 ID
     * @param string $sort 排序字段
     * @param string $where 额外的 WHERE 条件
     * @param string $childTable 子级数据表名
     * @param string $parentKey 父级 ID 字段名
     * @return mixed 数据及子级数据
     */
    
    public function showAll($table = null, $id = null, $sort = null, $where = null, $childTable = null, $parentKey = null)
    {
        // 获取有效的表名
        if (empty($table)) {
            $table = $this->table;
        }

        // 验证表名和找到的 ID 是否有效
        if (empty($table)) {
            return "表名不能为空"; // 返回错误信息
        }

        // 构建基本查询条件
        $conditions = [];
        if ($this->db->hasDeletedAt($table)) {
            if (empty($id)) {
                $conditions[] = "deleted_at IS NULL";
            } else {
                $conditions[] = "id = $id AND deleted_at IS NULL";
            }
        } else {
            if (!empty($id)) {
                $conditions[] = "id = $id";
            }
        }

        // 添加 WHERE 条件
        if (!empty($where)) {
            $conditions[] = $where; // 将额外的 WHERE 条件添加
        }

        // 构建 SQL 查询
        $whereClause = !empty($conditions) ? "WHERE " . implode(' AND ', $conditions) : "";
        
        // 根据排序的需求调用 select 或 selectOrder
        if (!empty($sort)) {
            $data = $this->db->selectOrder($table, $sort, $whereClause);
        } else {
            $data = $this->db->select($table, $whereClause);
        }

        // 处理子级数据
        if (!empty($childTable)) {
            if (empty($parentKey)) {
                $parentKey = 'parentId'; // 使用默认 parent key
            }
            foreach ($data as $key => $value) {
                $childConditions = $this->db->hasDeletedAt($childTable) 
                    ? "WHERE $parentKey = " . $value['id'] . " AND deleted_at IS NULL" 
                    : "WHERE $parentKey = " . $value['id'];
                $data[$key]['childData'] = $this->db->selectOrder($childTable, $sort, $childConditions);
            }
        }
        return $data; // 返回结果
    }

    /**
     * Summary of showAllWithChild
     * 显示详情及子级数据
     * @param string $table 数据表名
     * @param int $id 数据 ID
     * @param string $childTable 子级数据表名
     * @param string $parentKey 父级 ID 字段名
     * @return mixed 数据及子级数据
     */
    public function showAllWithChild($table = null, $id = null, $childTable = null, $parentKey = null)
    {
        // 获取有效的表名
        if (empty($table)) {
            $table = $this->table;
        }
    
        // 获取有效的 ID
        if (empty($id)) {
            $id = $this->id;
        }
    
        // 确保 ID 有效
        if (empty($id)) {
            // 获取数据
            if ($this->db->hasDeletedAt($table)) {
                $data['data'] = $this->db->select($table, "WHERE deleted_at IS NULL");
            } else {
                $data['data'] = $this->db->select($table);
            }
        }else{
            // 获取数据
            if ($this->db->hasDeletedAt($table)) {
                $data['data'] = $this->db->select($table, "WHERE id = $id AND deleted_at IS NULL");
            } else {
                $data['data'] = $this->db->select($table, "WHERE id = $id");
            }
        }

        // 确保数据存在
        if (empty($data['data'])) {
            return "未找到指定的数据"; // 提供错误信息
        }
    
        // 获取父级 ID
        $parentKey = empty($parentKey) ? 'parentId' : $parentKey; // 使用提供的 parentKey，或默认使用 'parentId'
        $parentIdValue = $data['data'][0]['id'] ?? null; // 处理可能的未定义索引

        // 获取子级数据
        if (!empty($childTable) && $parentIdValue !== null) {
            $data['childData'] = $this->db->selectOrder($childTable, "sort", "WHERE $parentKey = $parentIdValue");
        } else {
            $data['childData'] = []; // 如果没有子表或 parentId 为空，返回空子级数据
        }
        return $data; // 返回结果
    }
    
    /**
     * Summary of deleteSoft
     * 软删除
     * @return string 删除结果信息
     */
    public function deleteSoft()
    {
        // 获取 ID
        $id = $this->id;
    
        // 验证 ID 是否有效
        if (empty($id)) {
            return "ID 不能为空"; // 返回错误信息
        }
    
        // 准备软删除更新的数据
        $data = [
            "deleted_at" => date('Y-m-d H:i:s')
        ];
    
        // 执行更新操作
        $result = $this->db->update(Url::getTable(), $data, "WHERE id = $id");
        
        // 检查更新结果
        if (is_string($result)) {
            return $result; // 如果返回的是字符串，则为错误信息
        }
    
        return true; // 返回成功信息
    }
    
    /**
     * Summary of deleteSoftBatch
     * 批量软删除
     * @return mixed 删除结果信息
     */
    public function deleteSoftBatch()
    {
        // 验证 POST 中是否有 batchId
        if (empty($_POST['batchId'])) {
            return "批量 ID 不能为空"; // 返回错误信息
        }
    
        // 获取 IDs 并确保这些 ID 是整数
        $ids = array_map('intval', explode(',', $_POST['batchId'])); // 将批量 ID 转换为整数数组
    
        // 确保有有效的 ID
        if (empty($ids)) {
            return "没有有效的 ID 进行软删除"; // 返回错误信息
        }
    
        // 准备软删除的数据
        $data = [
            "deleted_at" => date('Y-m-d H:i:s')
        ];
    
        // 用 implode 构建 ID 字符串并执行更新
        $idsString = implode(',', $ids);
        return $this->db->update(Url::getTable(), $data, "WHERE id IN ($idsString)");
    }
    /**
     * Summary of delete
     * 彻底删除
     * @return string 删除结果信息
     */
    public function delete()
    {
        // 获取 ID
        $id = $this->id;

        // 验证 ID 是否有效
        if (empty($id)) {
            return "ID 不能为空"; // 返回错误信息
        }

        // 使用参数化查询以增强安全性，防止 SQL 注入
        $id = intval($id); // 确保 ID 是整数

        // 执行删除操作
        $result = $this->db->delete(Url::getTable(), "WHERE id = $id");

        // 检查执行结果并返回
        if (is_string($result)) {
            return $result; // 如果返回的是字符串，则为错误信息
        }

        return true; // 返回成功信息
    }
    /**
     * Summary of deleteBatch
     * 批量删除数据
     * @return mixed 删除结果信息
     */
    public function deleteBatch()
    {
        // 验证 POST 中是否有 batchId
        if (empty($_POST['batchId'])) {
            return "批量 ID 不能为空"; // 返回错误信息
        }

        // 获取 ID 数组并确保它们都是整数
        $ids = array_map('intval', explode(',', $_POST['batchId'])); // 将 ID 转换为整数数组

        // 确保至少有一个有效的 ID
        if (empty($ids)) {
            return "没有有效的 ID 进行删除"; // 返回错误信息
        }

        // 用 implode 构建 ID 字符串
        $idsString = implode(',', $ids);

        // 使用参数化查询更新数据
        return $this->db->delete(Url::getTable(), "WHERE id IN ($idsString)");
    }
    /**
     * Summary of restore
     * 还原数据
     * @return string 还原结果信息
     */
    public function restore()
    {
        // 获取 ID
        $id = $this->id;

        // 验证 ID 是否有效
        if (empty($id)) {
            return "ID 不能为空"; // 提供错误信息
        }

        // 确保 ID 是整数
        $id = intval($id); // 转换为整数

        // 执行软还原操作，更新 deleted_at 字段
        $result = $this->db->deleteDate(Url::getTable(), "WHERE id = $id");

        // 检查更新结果并返回
        if (is_string($result)) {
            return $result; // 如果返回的是字符串，则为错误信息
        }

        return true; // 返回成功信息
    }
    /**
     * Summary of restoreBatch
     * 批量还原数据
     * @return mixed 还原结果信息
     */
    public function restoreBatch()
    {
        // 验证 POST 中是否有 batchId
        if (empty($_POST['batchId'])) {
            return "批量 ID 不能为空"; // 返回错误信息
        }

        // 获取 ID 数组并确保它们都是整数
        $ids = array_map('intval', explode(',', $_POST['batchId'])); // 将 ID 转换为整数数组

        // 确保至少有一个有效的 ID
        if (empty($ids)) {
            return "没有有效的 ID 进行还原"; // 返回错误信息
        }

        // 用 implode 构建 ID 字符串
        $idsString = implode(',', $ids);

        // 执行批量还原操作
        $result = $this->db->deleteDate(Url::getTable(), "WHERE id IN ($idsString)");

        // 检查返回结果并返回
        if (is_string($result)) {
            return $result; // 如果返回的是字符串，则为错误信息
        }

        return true; // 返回成功信息
    }
}