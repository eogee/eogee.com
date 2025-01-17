<?php

use Easy\Database\CreateTable;

class CreateEmailQueueTable extends CreateTable
{
    protected $tableName = 'emailQueue';
    
    protected function setSql()
    {
        return "CREATE TABLE IF NOT EXISTS $this->tableName (

            id INT AUTO_INCREMENT PRIMARY KEY COMMENT 'ID',
            recipient VARCHAR(255) NOT NULL COMMENT '收件人邮箱',
            subject VARCHAR(255) NOT NULL COMMENT '主题',
            message TEXT NOT NULL COMMENT '内容',
            status ENUM('pending', 'processed', 'failed') DEFAULT 'pending' COMMENT '状态',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间'
            
        ) ENGINE= InnoDB DEFAULT CHARSET=utf8;
        ";
    }
}