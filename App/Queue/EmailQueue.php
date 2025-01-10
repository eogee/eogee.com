<?php

namespace App\Queue;

use App\Queue\Queue;
use Easy\Mail\Mail;

/**
 * 邮件队列
 */
class EmailQueue extends Queue
{
    private $mail;

    public function __construct()
    {
        parent::__construct();
        $this->mail = new Mail;
    }
    /**
     * Summary of getTableName
     * 获取表名
     * @return string
     */
    protected function getTableName()
    {
        return 'emailQueue';
    }

    /**
     * Summary of getInsertQuery
     * 获取插入队列项的 SQL 查询
     * @return string
     */
    protected function getInsertQuery()
    {
        return "INSERT INTO {$this->getTableName()} (recipient, subject, message, status) VALUES (?, ?, ?, 'pending')";
    }

    /**
     * Summary of bindInsertParams
     * 绑定插入队列项的参数
     * @param mixed $stmt
     * @param mixed $data
     * @return void
     */
    protected function bindInsertParams($stmt, $data)
    {
        $stmt->bind_param("sss", $data['recipient'], $data['subject'], $data['message']);
    }

    /**
     * Summary of getPendingQuery
     * 获取待处理队列项的 SQL 查询
     * @return string
     */
    protected function getPendingQuery()
    {
        return "SELECT * FROM {$this->getTableName()} WHERE status = 'pending'";
    }

    /**
     * Summary of processItem
     * 处理队列项
     * @param mixed $item
     * @return bool
     */
    protected function processItem($item)
    {
        $recipient = $item['recipient'];
        $subject = $item['subject'];
        $message = $item['message'];

        // 发送邮件（使用 mail() 函数或其他邮件发送库）
        return $this->mail->send($message, $message, $recipient,$subject);
    }
}