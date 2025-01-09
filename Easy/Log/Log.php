<?php

namespace Easy\Log;

use Easy\File\File;

/**
 * Summary of Log
 * 日志类
 * @author eogee eogee@qq.com
 */
class Log
{
    private $logFile = __DIR__ . '/../../'.CONFIG['log']['log_path'].'/'.CONFIG['log']['log_file'];
    
    private $logToConsole = CONFIG['log']['log_to_console'];

    private $logEnable = CONFIG['log']['log_enabled'];

    private $logFileName = CONFIG['log']['log_file'];

    private $logSortDesc = CONFIG['log']['log_sort_desc'];

    private static $lockFile = __DIR__ . '/../../'.CONFIG['log']['log_path'].'/'.CONFIG['log']['log_id_lock']; // 用于文件锁的文件

    private $logIdReset = CONFIG['log']['log_id_reset']; // 是否重置日志ID

    /**
     * Logger constructor.
     * @param string $logFile 日志文件路径
     * @param bool $logToConsole 是否将日志输出到控制台
     */
    public function __construct()
    {

    }

    /**
     * 获取下一个日志ID
     * @return int
     */
    private function getNextLogId()
    {
        // 确保文件存在并初始化
        if (!file_exists(self::$lockFile)) {
            file_put_contents(self::$lockFile, '0');
        }

        $fp = fopen(self::$lockFile, 'c+');
        if (flock($fp, LOCK_EX)) {
            try {
                // 重置文件指针到文件开头
                rewind($fp);

                // 读取当前的ID值（通过文件指针）
                $fileContent = fread($fp, filesize(self::$lockFile));
                $currentId = (int)trim($fileContent);

                $nextId = $currentId + 1;
    
                // 写入新的ID值
                ftruncate($fp, 0); // 清空文件
                rewind($fp); // 重置文件指针
                fwrite($fp, $nextId); // 写入新的ID
                flock($fp, LOCK_UN); // 释放锁
            } catch (\Exception $e) {
                flock($fp, LOCK_UN); // 确保锁被释放
                fclose($fp);
                throw new \RuntimeException("Failed to update log ID: " . $e->getMessage());
            }
            fclose($fp);
    
            return $nextId;
        } else {
            throw new \RuntimeException("Failed to acquire lock for log ID.");
        }
    }    

    /**
     * 记录日志
     * @param string $level 日志级别
     * @param string $message 日志信息
     */

    private function log($level, $message)
    {
        // 获取自增ID
        $logId = $this->getNextLogId();

        $logEntry = sprintf(
            "[%s] [ID: %d] %s: %s\n",
            date('Y-m-d H:i:s'),
            $logId, // 添加自增ID
            $level,
            $message
        );

        // 确保日志目录存在
        $logDir = dirname($this->logFile);

        if (!is_dir($logDir)) {
            if (file_exists($logDir)) {
                // 如果路径存在但不是目录，抛出异常或记录错误
                throw new \RuntimeException("Path exists but is not a directory: " . $logDir);
            } else {
                // 如果路径不存在，创建目录
                if (!mkdir($logDir, 0777, true)) {
                    throw new \RuntimeException("Failed to create directory: " . $logDir);
                }
            }
        }

        $fp = fopen($this->logFile, 'a'); // 以追加模式打开文件
        if (flock($fp, LOCK_EX)) { // 获取独占锁
            fwrite($fp, $logEntry); // 写入日志
            flock($fp, LOCK_UN); // 释放锁
        }
        fclose($fp); // 关闭文件

        // 如果需要，输出到控制台
        if ($this->logToConsole) {
            echo $logEntry;
        }
    }

    /**
     * 记录信息日志
     * @param string $message 日志信息
     */
    public function info($message)
    {
        if($this->logEnable){
            $this->log('INFO', $message);
        }       
    }

    /**
     * 记录错误日志
     * @param string $message 日志信息
     */
    public function error($message)
    {
        if($this->logEnable){
            $this->log('ERROR', $message);
        }
    }

    /**
     * 记录警告日志
     * @param string $message 日志信息
     */
    public function warning($message)
    {
        if($this->logEnable){
            $this->log('WARNING', $message);
        }
    }

    /**
     * 记录调试日志
     * @param string $message 日志信息
     */
    public function debug($message)
    {
        if($this->logEnable){
            $this->log('DEBUG', $message);
        }
    }    

    /**
     * 将日志文件内容转换为数组
     * 日志文件内容格式：[时间戳][ID][类型]: [数据1]：[值1]，[数据2]：[值2]，...
     * @return array
     */
    public function logToArray()
    {
        $logText = file_get_contents($this->logFile);
        // 按行分割日志
        $logLines = explode("\n", $logText);
    
        // 初始化结果数组
        $result = [];
    
        // 遍历每一行日志
        foreach ($logLines as $line) {
            // 跳过空行
            if (empty(trim($line))) {
                continue;
            }            
    
            // 解析日志行
            if (preg_match('/\[(.*?)\] \[ID: (\d+)\] (\w+): (.*)/', $line, $matches)) {
                $timestamp = $matches[1];   // 时间戳
                $id = $matches[2];          // 日志ID
                $type = $matches[3];        // 日志类型（比如 INFO）
                $logData = $matches[4];     // 日志数据部分
    
                // 解析日志数据部分
                $dataPairs = explode('，', $logData);
                $logEntry = ['timestamp' => $timestamp, 'id' => $id,'type' => $type];  // 添加 type
    
                foreach ($dataPairs as $pair) {
                    // 分割键值对
                    list($key, $value) = explode('：', $pair, 2);
                    // 将键值对添加到日志条目
                    $logEntry[trim($key)] = trim($value);
                }
    
                // 将解析后的日志条目添加到结果数组中
                $result[] = $logEntry;
            }
        }

        //$this->searchLog();//搜索日志

        if ($this->logSortDesc) // 按时间戳倒序排列
        {
            return array_reverse($result);
        }

        return $result;
    }

    /**
     * 每次返回10条日志内容(用于前端分页显示)
     * @return array
     */
    public function logByPage()
    {
        //获取分页参数
        $page = $_GET['page'] ?? 1;//获取当前页码
        $limit = $_GET['limit'] ?? 10;//获取每页显示条数

        $allData = $this->searchLog();//获取全部日志数据(不分页、带有搜索功能)
        $count = count($allData);
        $pageCount = ceil($count / 10);//计算总页数
        $start = ($page - 1) * $limit;//计算起始位置
        $pageData = array_slice($allData, $start, $limit);//获取当前页码日志数据

        //准备返回数据
        $data = [
            'code' => 0,
            'count' => $count,
            'data' => $pageData,
            'page' => $page,
            'pageCount' => $pageCount
        ];
        return $data;
    }

    /**
     * 当前分页下查看某一条日志内容
     * @param int $id 日志ID
     * @return array
     */
    public function logShow($id)
    {
        $pageData = $this->logByPage();
        $logData = $this->findLogById($pageData['data'], $id);
        return $logData[0];
    }
    /**
     * 根据ID查找日志内容
     * @param array $logs 日志数组
     * @param int $id 日志ID
     * @return array
     */
    function findLogById($logs, $id) {
        $result = [];
        foreach ($logs as $log) {
            if (isset($log['id']) && $log['id'] == $id) {
                $result[] = $log;
            }
        }
        return $result;
    }
    /**
     * 搜索日志内容
     * @return array
     */
    public function searchLog()
    {
        $search = $_GET['search'] ?? '';
        $allData = $this->logToArray();
        if (!empty($search)) {
            $result = [];
            foreach ($allData as $data) {
                foreach ($data as $key => $value) {
                    if (stripos($value, $search)!== false) {
                        $result[] = $data;
                        break;
                    }
                }
            }
            return $result;
        }        
        return $allData;
    }
    /**
     * 下载日志文件
     * @return void
     */
    public function downloadLog()
    {
        $file = new File;
        $file->downloadFile($this->logFile, $this->logFileName);
    }

    /**
     * 删除一条日志内容
     * @param int $id 日志ID
     * @return bool
     * @throws \RuntimeException 如果文件操作失败
     */
    public function logDelete($id)
    {
        // 日志文件路径
        $logFile = $this->logFile; // 替换为实际的日志文件路径

        // 检查文件是否存在
        if (!file_exists($logFile)) {
            throw new \RuntimeException("日志文件不存在: $logFile");
        }

        // 读取文件内容
        $logContent = file_get_contents($logFile);
        if ($logContent === false) {
            throw new \RuntimeException("无法读取日志文件: $logFile");
        }

        // 按行分割日志内容
        $logLines = explode("\n", trim($logContent));

        // 过滤掉匹配的日志行
        $newLogLines = array_filter($logLines, function($line) use ($id) {
            // 使用正则表达式匹配日志ID
            if (preg_match('/\[ID: (\d+)\]/', $line, $matches)) {
                $logId = $matches[1]; // 提取日志ID
                return $logId != $id; // 保留不匹配的日志行
            }
            return true; // 保留无法解析的日志行
        });

        // 将过滤后的日志行重新写入文件
        $newLogContent = implode("\n", $newLogLines);
        if (file_put_contents($logFile, $newLogContent) === false) {
            throw new \RuntimeException("无法写入日志文件: $logFile");
        }
        return true;
    }

    /**
     * 清空日志文件内容
     * @return bool
     */
    public function clearLog()
    {
        file_put_contents($this->logFile, '');        
        if ($this->logIdReset) {
            $this->logIdReset();
        }
        return true;
    }
    /**
     * 重置日志ID
     * @return void
     */
    public function logIdReset()
    {
        file_put_contents(self::$lockFile, '0');
    }
}
