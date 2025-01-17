<?php

use Easy\Database\CreateTable;

class CreateTestTable extends CreateTable
{
    protected $tableName = 'test';

    protected function setSql()
    {
        return "CREATE TABLE IF NOT EXISTS $this->tableName (
            id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'ID',

            // You can add your columns here...

            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'
        ) ENGINE= InnoDB DEFAULT CHARSET=utf8;
        ";
    }
}