<?php

namespace App\Queue;

use App\Queue\Queue;

/**
 * 邮件队列
 */
class EmailQueue extends Queue
{
    /**
     * Summary of getTableName
     * 获取表名
     * @return string
     */
    protected function getTableName()
    {
        return 'email_queue';
    }

    /**
     * Summary of getInsertQuery
     * 获取插入队列项的 SQL 查询
     * @return string
     */
    protected function getInsertQuery()
    {
        return "INSERT INTO {$this->getTableName()} (recipient_email, subject, message, status) VALUES (?, ?, ?, 'pending')";
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
     * @param mixed $item
     * @return bool
     */
    protected function processItem($item)
    {
        $recipient = $item['recipient_email'];
        $subject = $item['subject'];
        $message = $item['message'];

        // 发送邮件（使用 mail() 函数或其他邮件发送库）
        return mail($recipient, $subject, $message);
    }
}