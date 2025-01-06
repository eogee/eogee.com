<?php

class CreateUsersTable
{
    private $mysqli;

    protected $tableName = "users";

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }
    protected function setSql()
    {
        return "CREATE TABLE IF NOT EXISTS $this->tableName (
            id INT(11) NOT NULL AUTO_INCREMENT,
            username VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    }
    public function up()
    {
        // 创建 users 表
        $sql = $this->setSql();
        // 执行 SQL
        $this->executeQuery($sql);
    }

    public function down()
    {
        // 删除 users 表
        $sql = "DROP TABLE IF EXISTS $this->tableName;";
        $this->executeQuery($sql);
    }

    private function executeQuery($sql)
    {
        if ($this->mysqli->query($sql) === TRUE) {
            echo "Query executed successfully.\n";
        } else {
            echo "Error executing query: " . $this->mysqli->error . "\n";
        }
    }
}