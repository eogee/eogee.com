<?php

class CreateEmailQueueTable
{
    protected $tableName = 'emailQueue';

    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function up()
    {
        $sql = "CREATE TABLE IF NOT EXISTS $this->tableName (
            id INT AUTO_INCREMENT PRIMARY KEY COMMENT 'ID',
            recipient VARCHAR(255) NOT NULL COMMENT '收件人邮箱',
            subject VARCHAR(255) NOT NULL COMMENT '主题',
            message TEXT NOT NULL COMMENT '内容',
            status ENUM('pending', 'processed', 'failed') DEFAULT 'pending' COMMENT '状态',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间'
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ";
        $this->executeQuery($sql);
    }

    public function down()
    {
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