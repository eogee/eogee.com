<?php

namespace Easy\Database;

/**
 * Summary of Database
 * 数据库操作类
 * @author Eogee
 * @email eogee@qq.com 
 */
class Database
{
    protected $host;
    protected $username;
    protected $password;
    protected $database;
    protected $charset;
    protected $table;//表名
    public $conn;//数据库连接资源
    private static $instance;//单例模式实例

    /**
     * Summary of __construct
     * 构造函数，连接数据库
     */
    private function __construct()
    {
        $this->host = CONFIG['database']['host'];
        $this->username = CONFIG['database']['user'];
        $this->password = CONFIG['database']['password'];
        $this->database = CONFIG['database']['name'];
        $this->charset = CONFIG['database']['charset'];
        // 连接数据库
        $this->conn = $this->connectDatabase();
    }

    private function connectDatabase()
    {
        // 创建数据库连接
        $conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        // 检查连接是否成功
        if (!$conn) {
            die("数据库连接失败: " . mysqli_connect_error());
        }
        // 设置字符集
        mysqli_set_charset($conn, $this->charset);        
        return $conn;
    }
    /**
     * Summary of prepare
     * 准备 SQL 语句
     */
    public function prepare($sql)
    {
        // 确保数据库连接存在
        if ($this->conn === null) {
            return "数据库连接未初始化";
        }
        // 使用 mysqli 的 prepare 方法准备 SQL 语句
        $stmt = mysqli_prepare($this->conn, $sql);
        // 检查准备是否成功
        if ($stmt === false) {
            return "准备 SQL 语句失败: " . mysqli_error($this->conn);
        }
        return $stmt; // 返回准备好的语句对象
    }

    /**
     * Summary of getInstance
     * 单例模式获取实例
     */
    public static function getInstance()
    {
        if(!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }
    /**
     * Summary of query
     * 数据库查询操作
     * @param string $sql SQL语句
     * @return mixed 查询结果集
     */
    protected function query($sql)
    {
        $result = mysqli_query($this->conn, $sql);        
        if ($result === false) {
            if(CONFIG['app']['developer_mode'] == true){
                return $sql; // 开发模式下返回SQL语句
            }else{
                return false; // 生产模式下返回false
            }
        }        
        // 如果查询结果是对象，则将对象转换为数组
        if (is_object($result)) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC); // 直接转为关联数组
        }
        return true; // 查询成功但无结果时返回 true
    }
    /**
     * Summary of insert
     * 新增数据
     * @param string $table 表名
     * @param array $data 要插入的数据
     */
    public function insert($table, array $data)
    {
        // 确保数据不为空
        if (empty($data)) {
            return "插入数据不能为空"; // 返回错误信息
        }
    
        // 使用参数化查询以增强安全性，防止 SQL 注入
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
    
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
    
        // 准备 SQL 语句
        $stmt = $this->prepare($sql);
    
        // 确保准备成功
        if ($stmt === false) {
            return "准备 SQL 语句失败: " . mysqli_error($this->conn);
        }
    
        // 创建类型字符串
        $types = str_repeat('s', count($data)); // 默认为字符串类型
        $params = array_merge([$types], array_values($data)); // 结合类型和数据
    
        // 创建引用数组
        $refParams = [];
        foreach ($params as $key) {
            $refParams[$key] = &$params[$key]; // 确保每个参数都是引用
        }
    
        // 将参数作为引用绑定
        call_user_func_array([$stmt, 'bind_param'], $refParams);
    
        // 执行语句
        if (!$stmt->execute()) {
            return "执行插入失败: " . $stmt->error; // 返回错误信息
        }
    
        return $stmt->insert_id; // 返回插入的自增ID
    }
    /**
     * Summary of delete
     * 删除数据
     * @param string $table 表名
     * @param string $where WHERE 子句
     * @return mixed 执行结果
     */
    public function delete($table, $where)
    {
        // 验证 WHERE 子句是否提供
        if (empty($where)) {
            return "WHERE 子句不能为空"; // 返回错误信息
        }

        // 转义字符串，防止SQL注入
        $table = $this->conn->real_escape_string($table);
        $where = $this->conn->real_escape_string($where);
        $sql = "DELETE FROM $table $where";

        // 调用 query 方法执行查询
        return $this->query($sql);

    }
    /**
     * Summary of update
     * 更新数据
     * @param string $table 表名
     * @param array $data 要更新的数据
     * @param string $where WHERE 子句
     * @return mixed 执行结果
     */
    public function update($table, array $data, $where)
    {
        // 确保数据不为空
        if (empty($data)) {
            return "更新数据不能为空"; // 返回错误信息
        }

        // 验证 WHERE 子句是否提供
        if (empty($where)) {
            return "WHERE 子句不能为空"; // 返回错误信息
        }

        // 使用参数化查询以增强安全性，防止 SQL 注入
        $setClause = [];
        foreach ($data as $k => $v) {
            $setClause[] = "$k = ?";  // 使用 ? 作为占位符
        }
        $setStr = implode(', ', $setClause);

        $table = $this->conn->real_escape_string($table);
        $where = $this->conn->real_escape_string($where);

        $sql = "UPDATE $table SET $setStr $where";

        // 准备 SQL 语句
        $stmt = $this->prepare($sql);

        // 确保准备成功
        if ($stmt === false) {
            return "准备 SQL 语句失败: " . mysqli_error($this->conn); // 返回错误信息
        }

        // 创建类型字符串
        $types = str_repeat('s', count($data)); // 默认为字符串类型
        $params = array_merge([$types], array_values($data)); // 结合类型和数据

        // 创建引用数组
        $refParams = [];
        foreach ($params as $key => &$value) {
            $refParams[$key] = &$value; // 确保每个参数都是引用
        }

        // 将参数作为引用绑定
        call_user_func_array([$stmt, 'bind_param'], $refParams);

        // 执行语句
        if (!$stmt->execute()) {
            return "执行更新失败: " . $stmt->error; // 返回错误信息
        }

        return $stmt->affected_rows; // 返回受影响的行数
    }

   /**
     * Summary of select
     * 查询一条或全部数据，默认根据id倒序排序，不限制条数
     * @param string $table 表名
     * @param string $where WHERE 子句
     * @param string $limit LIMIT 子句
     * @return mixed 查询结果集
     */
    public function select($table, $where = null, $limit = null)
    {
        // 验证表名是否有效
        if (empty($table)) {
            return "表名不能为空"; // 返回错误信息
        }

        $sql = "SELECT * FROM $table";

        // 如果有 WHERE 子句，添加到 SQL 查询中
        if (!empty($where)) {
            $sql .= " $where"; // 确保 $where 不为空
        }
                
        $sql .= " ORDER BY id DESC"; // 最后添加排序

        // 添加 LIMIT 子句
        if (!empty($limit)) {
            $limit = $this->conn->real_escape_string($limit);
            $sql .= " $limit"; // 确保 $limit 不为空
        }

        // 执行查询
        return $this->query($sql);
    }
    /**
     * Summary of hasTable
     * 判断表是否存在
     * @param string $table 表名
     * @return mixed 查询结果集
     */
    public function hasTable($table)
    {
        // 验证表名是否有效
        if (empty($table)) {
            return '表名不能为空'; // 返回 false 如果没有提供表名
        }

        // 使用字符串拼接构建 SQL 查询
        $sql = "SHOW TABLES LIKE '" . $this->conn->real_escape_string($table) . "'";

        // 执行查询
        $result = $this->query($sql);

        // 检查结果集是否有记录
        return $result && count($result) > 0; // 直接返回布尔值
    }
    /**
     * Summary of hasCol
     * 判断表是否有指定字段
     * @param string $col 列名
     * @param string $table 表名
     * @return mixed 查询结果集
     */
    public function hasCol($col, $table)
    {
        // 验证表名和列名是否有效
        if (empty($col) || empty($table)) {
            return "列名或表名不能为空"; 
        }

        // 使用字符串拼接构建 SQL 查询，使用 real_escape_string 防止 SQL 注入
        $table = $this->conn->real_escape_string($table);
        $col = $this->conn->real_escape_string($col);
        $sql = "SHOW COLUMNS FROM $table LIKE '$col'";

        // 执行查询
        $result = $this->query($sql);

        // 直接返回布尔值
        return $result && count($result) > 0; // 检查结果集是否有记录
    }

    /**
     * Summary of hasDeletedAt
     * 判断表是否有 删除时间戳 字段
     * @param string $table 表名
     * @return mixed 查询结果集
     */
    public function hasDeletedAt($table) 
    {
        // 验证表名是否有效
        if (empty($table)) {
            return '表名不能为空'; // 返回提示信息
        }

        // 使用字符串拼接前对表名进行转义以防止 SQL 注入
        $table = $this->conn->real_escape_string($table);
        $sql = "SHOW COLUMNS FROM $table LIKE 'deleted_at'";

        // 执行查询
        $result = $this->query($sql);

        // 直接返回布尔值
        return $result && count($result) > 0; // 检查结果集是否有记录
    }
    /**
     * Summary of selectOrder
     * 查询数据 并根据根据特定字段 倒序排序
     * @param string $table 表名
     * @param string $col 列名
     * @param string $where WHERE 子句
     * @param string $limit LIMIT 子句
     * @return mixed 查询结果集
     */
    public function selectOrder($table,$col,$where = null,$limit = null)
    {
        // 验证表名和列名是否有效
        if (empty($table) || empty($col)) {
            return "表名和列名不能为空"; // 返回错误信息
        }

        // 使用字符串转义来避免 SQL 注入
        $table = $this->conn->real_escape_string($table);
        $col = $this->conn->real_escape_string($col);
        $limit = $this->conn->real_escape_string($limit);
        
        $sql = "SELECT * FROM $table $where ORDER BY $col DESC $limit";

        return $this->query($sql);
    }
    /**
     * Summary of selectCol
     * 查询特定字段col数据 并根据特定字段sortCol 倒序排序
     * @param string $table 表名
     * @param string $col 列名
     * @param string $where WHERE 子句
     * @param string $sortCol 排序列名
     * @param string $desc 排序方式
     * @return mixed 查询结果集
     */
    public function selectCol($table, $col,$where = null,$sortCol = "id",$desc = "DESC")
    {
        // 验证表名和列名是否有效
        if (empty($table) || empty($col) || empty($sortCol)) {
            return "表名、列名或排序列名不能为空"; // 返回错误信息
        }

        // 使用字符串转义来避免 SQL 注入
        $table = $this->conn->real_escape_string($table);
        $col = $this->conn->real_escape_string($col);
        $where = $this->conn->real_escape_string($where);
        $sortCol = $this->conn->real_escape_string($sortCol);
        $desc = $this->conn->real_escape_string($desc);

        $sql = "SELECT $col from $table $where ORDER BY $sortCol $desc";
        return $this->query($sql);
    }
    /**
     * Summary of tableComment
     * 获取表注释
     * @param string $table 表名
     * @return mixed 查询结果集
     */
    public function tableComment($table)
    {
        // 验证表名是否有效
        if (empty($table)) {
            return "表名不能为空"; // 返回错误信息
        }

        // 获取数据库名
        $database = $this->database;

        // 使用字符串转义以防止 SQL 注入
        $table = $this->conn->real_escape_string($table);

        // 构建 SQL 查询
        $sql = "SELECT TABLE_COMMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$database' AND TABLE_NAME = '$table'";

        // 执行查询并返回结果
        return $this->query($sql);
    }
    /**
     * Summary of columnComment
     * 获取字段注释
     * @param string $table 表名
     * @return mixed 查询结果集
     */
    public function columnComment($table)
    {
        // 验证表名是否有效
        if (empty($table)) {
            return "表名不能为空"; // 返回错误信息
        }

        // 获取数据库名
        $database = $this->database;

        // 使用字符串转义以防止 SQL 注入
        $table = $this->conn->real_escape_string($table);

        // 构建 SQL 查询
        $sql = "SELECT COLUMN_NAME, COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$database' AND TABLE_NAME = '$table' ORDER BY ORDINAL_POSITION;";

        return $this->query($sql);
    }
    /**
     * Summary of updateColumnComment
     * 修改字段注释
     * @param string $table 表名
     * @param string $col 列名
     * @param string $colType 列类型
     * @param string $comment 注释
     * @return mixed 查询结果集
     */
    public function updateColumnComment($table,$col,$colType,$comment)
    {
        // 验证表名、字段名、字段类型、注释是否有效
        if (empty($table) || empty($col) || empty($colType) || empty($comment)) {
            return "表名、字段名、字段类型、注释不能为空"; // 返回错误信息
        }

        // 使用字符串转义以防止 SQL 注入
        $table = $this->conn->real_escape_string($table);
        $col = $this->conn->real_escape_string($col);
        $colType = $this->conn->real_escape_string($colType);
        $comment = $this->conn->real_escape_string($comment);

        // 构建 SQL 查询
        $sql = "ALTER TABLE $table MODIFY COLUMN $col $colType COMMENT '$comment'";

        return $this->query($sql);
    }
    /**
     * Summary of columnIsnullable
     * 获取字段是否允许为空
     * @param string $table 表名
     * @return mixed 查询结果集
     */
    public function columnIsnullable($table)
    {
        // 验证表名是否有效
        if (empty($table)) {
            return "表名不能为空"; // 返回错误信息
        }

        // 使用字符串转义以防止 SQL 注入
        $table = $this->conn->real_escape_string($table);
        
        // 构建 SQL 查询
        $sql = "SELECT COLUMN_NAME, IS_NULLABLE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$table'";

        return $this->query($sql);
    }
    /**
     * Summary of deleteDate
     * 清空删除时间戳
     * @param string $table 表名
     * @param string $where WHERE 子句
     * @return mixed 查询结果集
     */
/**
 * Summary of deleteDate
 * 清空删除时间戳
 * @param string $table 表名
 * @param string $where WHERE 子句
 * @return mixed 查询结果集
 */
public function deleteDate($table, $where = null) 
{
    // 验证表名是否有效
    if (empty($table)) {
        return "表名不能为空"; // 返回错误信息
    }

    // 使用字符串转义以防止 SQL 注入
    $table = $this->conn->real_escape_string($table);
    $where = $this->conn->real_escape_string($where);
    
    // 构建 SQL 查询
    $sql = "UPDATE $table SET deleted_at = NULL $where";

    $this->query($sql);
}

    /**
     * Summary of deleteReadedDate
     * 清空已读时间戳
     * @param string $table 表名
     * @param string $where WHERE 子句
     * @return mixed 查询结果集
     */
    public function deleteReadedDate($table, $where = null) 
    {
        // 验证表名是否有效
        if (empty($table)) {
            return "表名不能为空"; // 返回错误信息
        }

        // 使用字符串转义以防止 SQL 注入
        $table = $this->conn->real_escape_string($table);
        $where = $this->conn->real_escape_string($where);

        // 构建 SQL 查询
        $sql = "UPDATE $table SET readed_at = NULL $where";

        $this->query($sql);
    }

    /**
     * Summary of sum
     * 计算特定字段的总和，默认每批次计算100条
     * @param string $table 表名
     * @param string $col 列名
     * @param string $where WHERE 子句
     * @param int $batchSize 每批次计算条数
     * @return mixed 查询结果集
     */
    public function sum($table, $col, $where = null, $batchSize = 100) 
    {
        // 验证表名和字段名是否有效
        if (empty($table) || empty($col)) {
            return "表名和字段名不能为空"; // 返回错误信息
        }

        // 使用字符串转义来避免 SQL 注入
        $table = $this->conn->real_escape_string($table);
        $col = $this->conn->real_escape_string($col);
        $where = $this->conn->real_escape_string($where);

        // 初始总和
        $sum = 0;
        $offset = 0;

        // 使用循环分批次查询总和
        while (true) {
            // 构建 SQL 查询
            $sql = "SELECT SUM($col) AS total FROM $table " . ($where ? "$where" : "") . " LIMIT $batchSize OFFSET $offset";
            $result = $this->query($sql);

            // 检查结果
            if ($result && count($result) > 0) {                
                $sum += (float)$result[0]['total']; // 将结果转换为浮点数
                $offset += $batchSize; // 增加偏移量以获取下一批数据
            } else {
                break; // 如果没有更多结果则退出循环
            }
        }

        return $sum; // 返回总和
    }
    /**
     * Summary of __destruct
     * 析构函数，释放数据库资源
     */
    public function __destruct()
    {
        mysqli_close($this->conn);
    }
}