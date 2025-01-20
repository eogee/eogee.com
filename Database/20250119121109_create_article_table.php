<?php

use Easy\Database\CreateTable;

class CreateArticleTable extends CreateTable
{
    protected $tableName = 'article';

    protected function setSql()
    {
        return "CREATE TABLE IF NOT EXISTS $this->tableName (
            id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'ID',

            title VARCHAR(255) NOT NULL COMMENT '标题',
            keywords VARCHAR(255) NOT NULL COMMENT '关键字',
            description VARCHAR(255) NOT NULL COMMENT '描述',
            content TEXT NOT NULL COMMENT '内容',
            authorId INT(11) NOT NULL COMMENT '作者ID',
            authorUsername VARCHAR(255) NOT NULL COMMENT '作者用户名',
            authorNickname VARCHAR(255) NULL COMMENT '作者昵称',
            categoryId INT(11) NOT NULL COMMENT '分类ID',
            categoryName VARCHAR(255) NOT NULL COMMENT '分类名称',
            sort INT(11) NULL DEFAULT 0 COMMENT '排序',

            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
            deleted_at DATETIME NULL DEFAULT NULL COMMENT '删除时间',

            FOREIGN KEY (categoryId) REFERENCES category(id) ON DELETE CASCADE ON UPDATE CASCADE
        ) ENGINE= InnoDB DEFAULT CHARSET=utf8 COMMENT='文章管理';
        ";
    }
}