<?php
namespace Model;
/**
 * Summary of Database
 * 数据库操作类
 * @author eogee.com
 * @version 1.0.0
 * @bugContacts: You can contact us by email:eogee@qq.com or QQ: 3886370035
 * @联系我们: 邮箱:eogee@qq.com 或 QQ: 3886370035
 */

class Database
{
    protected $host = CONFIG['db_host'];
    protected $username = CONFIG['db_user'];
    protected $password = CONFIG['db_password'];
    protected $database = CONFIG['db_name'];
    protected $charset = CONFIG['db_charset'];
    protected $table;//表名
    protected $conn;//数据库连接资源
    private static $instance;//单例模式实例

    /**
     * Summary of __construct
     * 构造函数，连接数据库
     */
    private function __construct()
    {
        $conn = mysqli_connect( $this->host, $this->username, $this->password, $this->database);
        if (!$conn) {
            die("数据库链接失败！". mysqli_connect_error() );
        }
        mysqli_set_charset($conn, $this->charset);
        $this->conn = $conn;
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
     */
    protected function query($sql)
    {        
        $result = mysqli_query($this->conn, $sql);
        $arr = [];
        if(is_object($result)){//如果查询结果是对象，则将对象转换为数组
            foreach($result as $k=>$v){
                $arr[] = $v;
            }
            return $arr;
        }else{
            if($result){
                return true;
            }else{
                return false;
            }
        }
    }
    /**
     * Summary of queryGetId
     * 数据库新增操作并返回自增ID 配合 insertGetId使用
     */
    protected function queryGetId($sql)
    {
        $result = mysqli_query($this->conn, $sql);
        if($result){
            return mysqli_insert_id( $this->conn );
        }else{
            return $sql;
        }
    }
    /**
     * Summary of insert
     * 新增数据
     */
    public static function insert($table, array $data)
    {
        $str = "";
        foreach($data as $k=>$v){
            $str .= "$k='$v',";//将数组内容拼接为字符串
        }
        $str = rtrim($str,",");//删除最后一个“,”
        $sql = "insert into ".$table." set ".$str;//新增sql语句
        self::getInstance()->query($sql);//执行操作请求
    }
    /**
     * Summary of insertGetId
     * 新增数据并返回自增ID
     */
    public static function insertGetId($table, array $data)
    {
        $str = "";
        foreach($data as $k=>$v){
            $str .= "$k='$v',";
        }
        $str = rtrim($str,",");
        $sql = "insert into ".$table." set ".$str;
        return self::getInstance()->queryGetId($sql);
    }
    /**
     * Summary of delete
     * 删除数据
     */
    public static function delete($table, $where)
    {
        $sql = "delete from ".$table." ".$where;
        self::getInstance()->query($sql);
    }
    /**
     * Summary of update
     * 更新数据
     */
    public static function update($table, array $data, $where)
    {
        $str = "";
        foreach($data as $k=>$v){            
            $str .= "$k='$v',";      
        }
        $str = rtrim($str,",");
        $sql = "update ".$table." set ".$str." ".$where;
        self::getInstance()->query($sql);
    }
    /**
     * Summary of select
     * 查询一条或全部数据 默认：根据id倒序排序，不限制条数
     */
    public static function select($table,$where = null,$limit = null)
    {        
        $sql = "select * from ".$table." ".$where." ORDER BY id DESC"." ".$limit;
        return self::getInstance()->query($sql);
    }
    /**
     * Summary of hasTable
     * 判断表是否存在
     */
    public static function hasTable($table)
    {
        $sql = "SHOW TABLES LIKE '$table'";
        $result = self::getInstance()->query($sql);
        if (count($result) > 0) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Summary of hasCol
     * 判断表是否有指定字段
     */
    public static function hasCol($col,$table) 
    {
        $sql = "SHOW COLUMNS FROM `$table` LIKE '$col'";
        $result = self::getInstance()->query($sql);

        // 确保 $result 是有效的，并处理潜在的错误
        if ($result !== false) {
            return count($result) > 0; // 返回布尔值
        } else {
            // 处理查询失败的情况
            return false;
        }

    }
    /**
     * Summary of hasDeletedAt
     * 判断表是否有删除时间戳字段
     */
    public static function hasDeletedAt($table) 
    {
        $sql = "SHOW COLUMNS FROM $table LIKE 'deleted_at'";
        $result = self::getInstance()->query($sql);
        // 确保 $result 是有效的，并处理潜在的错误
        if ($result !== false) {
            return count($result) > 0; // 返回布尔值
        } else {
            // 处理查询失败的情况
            return false;
        }
    }
    /**
     * Summary of selectOrder
     * 查询数据 并根据根据特定字段 倒序排序
     */
    public static function selectOrder($table,$col,$where = null,$limit = null)
    {
        $sql = "select * from ".$table." ".$where." order by ".$col." desc"." ".$limit;
        return self::getInstance()->query($sql);
    }
    /**
     * Summary of selectCol
     * 查询特定字段col数据 并根据特定字段sortCol 倒序排序
     */
    public static function selectCol($table, $col,$where = null,$sortCol = "id",$desc = "DESC")
    {
        $sql = "select $col from ".$table." ".$where." ORDER BY $sortCol $desc";
        return self::getInstance()->query($sql);
    }
    /**
     * Summary of tableComment
     * 获取表注释
     */
    public static function tableComment($table)
    {
        $database = self::getInstance()->database;
        $sql = "SELECT TABLE_COMMENT FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$database' AND TABLE_NAME = '$table'";
        return self::getInstance()->query($sql);
    }
    /**
     * Summary of columnComment
     * 获取字段注释
     */
    public static function columnComment($table)
    {
        $database = self::getInstance()->database;
        $sql = "SELECT COLUMN_NAME, COLUMN_COMMENT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$database' AND TABLE_NAME = '$table' ORDER BY ORDINAL_POSITION;";
        return self::getInstance()->query($sql);
    }
    /**
     * Summary of updateField
     * 修改字段注释
     */
    public static function updateColumnComment($table,$field,$fieldType,$comment)
    {
        $sql = "ALTER TABLE $table MODIFY COLUMN $field $fieldType COMMENT '$comment'";
        return self::getInstance()->query($sql);
    }
    /**
     * Summary of columnIsnullable
     * 获取字段是否允许为空
     */
    public static function columnIsnullable($table)
    {
        $sql = "SELECT COLUMN_NAME, IS_NULLABLE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$table'";
        return self::getInstance()->query($sql);
    }
    /**
     * Summary of deleteDate
     * 清空删除时间戳
     */
    public static function deleteDate($table, $where = null) 
    {
        $sql = "update ".$table." set deleted_at = null ".$where;
        self::getInstance()->query($sql);
    }
    /**
     * Summary of deleteReadedDate
     * 清空已读时间戳
     */
    public static function deleteReadedDate($table, $where = null) 
    {
        $sql = "update ".$table." set readed_at = null ".$where;
        self::getInstance()->query($sql);
    }
    /**
     * Summary of sum
     * 计算特定字段的总和 默认每批次计算100条
     */
    public static function sum($table,$filed,$where = null,$offset=0,$batchSize = 100) 
    {
        $sum = 0;
        while(true){
            $sql = "SELECT SUM($filed) AS total FROM $table $where limit $batchSize offset $offset";
            $result = self::getInstance()->query($sql);
            if (count($result) > 0) {                
                $sum += $result[0]['total'];
                $offset += $batchSize;
            } else {
                break;             
            }
        }
        return $sum;
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
