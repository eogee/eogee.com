<?php

use Easy\Database\CreateTable;

class CreateCategoryTable extends CreateTable
{
    protected $tableName = 'category';

    protected function setSql()
    {
        return "CREATE TABLE IF NOT EXISTS $this->tableName (
            id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'ID',

            name VARCHAR(255) NOT NULL COMMENT '名称',
            keywords VARCHAR(255) DEFAULT NULL COMMENT '关键词',
            description VARCHAR(255) DEFAULT NULL COMMENT '描述',
            sort INT(11) DEFAULT 0 COMMENT '排序',

            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
            deleted_at DATETIME DEFAULT NULL COMMENT '删除时间'
        ) ENGINE= InnoDB DEFAULT CHARSET=utf8 COMMENT='文章分类';
        ";
    }
}