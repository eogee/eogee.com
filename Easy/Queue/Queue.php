<?php

namespace Easy\Queue;

use mysqli;

/**
 * Summary of Queue
 * 队列基类
 * @author Eogee
 * @email eogee@qq.com 
 */
abstract class Queue
{
    private $conn;
    protected $host;
    protected $user;
    protected $password;
    protected $database;

    /**
     * Summary of __construct
     * 构造函数：连接数据库
     */
    public function __construct($config)
    {
        $this->host = $config['database']['host'];
        $this->user = $config['database']['user'];
        $this->password = $config['database']['password'];
        $this->database = $config['database']['name'];

        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("连接失败: " . $this->conn->connect_error);
        }
    }

    /**
     * Summary of addToQueue
     * 添加队列项
     * @param mixed $data
     * @return void
     */
    public function addToQueue($data)
    {
        $stmt = $this->conn->prepare($this->getInsertQuery());
        if ($stmt === false) {
            throw new \Exception("SQL预处理失败: " . $this->conn->error);
        }
        $this->bindInsertParams($stmt, $data);

        if (!$stmt->execute()) {
            echo "添加队列项失败: " . $stmt->error . "\n";
        }

        $stmt->close();
    }

    /**
     * Summary of processQueue
     * 处理队列项
     * @return bool
     */

    public function processQueue()
    {
        $result = $this->conn->query($this->getPendingQuery());
        $allProcessed = true; // 初始化变量，假设所有项都处理成功

        while ($row = $result->fetch_assoc()) {
            if ($this->processItem($row)) {
                $this->updateStatus($row['id'], 'processed');
            } else {
                $this->updateStatus($row['id'], 'failed');
                echo "队列项处理失败: {$row['id']}\n";
                $allProcessed = false; // 一旦有失败项，设置为 false
            }
        }

        return $allProcessed; // 返回处理结果
    }


    /**
     * Summary of updateStatus
     * 更新队列项状态
     * @param mixed $id
     * @param mixed $status
     * @return void
     */
    protected function updateStatus($id, $status)
    {
        $stmt = $this->conn->prepare("UPDATE {$this->getTableName()} SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
        $stmt->close();
    }

    /**
     * Summary of __destruct
     * 析构函数：关闭数据库连接
     */
    public function __destruct()
    {
        $this->conn->close();
    }

    /**
     * Summary of getTableName
     * 获取队列表名
     */
    abstract protected function getTableName();

    /**
     * Summary of getInsertQuery
     * 获取插入队列项的 SQL 查询
     */
    abstract protected function getInsertQuery();

    /**
     * Summary of bindInsertParams
     * 绑定插入队列项的参数
     */
    abstract protected function bindInsertParams($stmt, $data);

    /**
     * Summary of getPendingQuery
     * 获取待处理队列项的 SQL 查询
     */
    abstract protected function getPendingQuery();

    /**
     * Summary of processItem
     * 处理队列项
     */
    abstract protected function processItem($item);
}