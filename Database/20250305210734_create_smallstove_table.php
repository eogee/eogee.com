<?php

use Easy\Database\CreateTable;

class CreateSmallstoveTable extends CreateTable
{
    protected $tableName = 'smallstove';

    protected function setSql()
    {
        return "CREATE TABLE IF NOT EXISTS $this->tableName (
            id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'ID',

            modelName VARCHAR(255) NOT NULL COMMENT '小模型平台名称',
            betterName VARCHAR(255) NOT NULL COMMENT '其他名称',
            email VARCHAR(255) NOT NULL COMMENT '邮箱地址',
            industry VARCHAR(255) NOT NULL COMMENT '行业',
            job VARCHAR(255) NOT NULL COMMENT '职业',
            sex INT(11) NOT NULL COMMENT '性别',
            test INT(11) NULL COMMENT '模型训练经验',
            VRAM INT(11) NOT NULL COMMENT '显卡显存',
            llamafactory INT(11) NOT NULL COMMENT '能否安装llamafactory',
            data text NOT NULL COMMENT '大模型与大数据',

            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'
        ) ENGINE= InnoDB DEFAULT CHARSET=utf8;
        ";
    }
}