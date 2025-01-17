<?php

namespace Easy\Database;

/**
 * Summary of CreateTable
 * 数据库表创建类
 * @author eogee
 * @email eogee@qq.com
 */
abstract class CreateTable
{
    private $mysqli;// mysqli 实例

    protected $tableName;// 表名

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    /**
     * Summary of up
     * 执行创建表
     * @return void
     */
    public function up()
    {
        $sql = $this->setSql();
        $this->executeQuery($sql);
    }

    /**
     * Summary of down
     * 执行删除表
     * @return void
     */
    public function down()
    {
        $sql = "DROP TABLE IF EXISTS $this->tableName;";
        $this->executeQuery($sql);
    }

    /**
     * Summary of executeQuery
     * 执行 SQL 语句
     * @param string $sql SQL 语句
     * @return void
     */
    private function executeQuery($sql)
    {
        if ($this->mysqli->query($sql) === TRUE) {
            echo "Query executed successfully.\n";
        } else {
            echo "Error executing query: " . $this->mysqli->error . "\n";
        }
    }

    /**
     * Summary of setSql
     * 抽象方法 设置创建表的 SQL 语句
     * @return string SQL 语句
     */
    abstract protected function setSql();
}