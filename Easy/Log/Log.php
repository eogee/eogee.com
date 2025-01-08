<?php

namespace Easy\Log;

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

    /**
     * Logger constructor.
     * @param string $logFile 日志文件路径
     * @param bool $logToConsole 是否将日志输出到控制台
     */
    public function __construct()
    {

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
     * 记录日志
     * @param string $level 日志级别
     * @param string $message 日志信息
     */
    private function log($level, $message)
    {
        $logEntry = sprintf(
            "[%s] %s: %s\n",
            date('Y-m-d H:i:s'),
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
     * 将日志文件内容转换为数组
     * 日志文件内容格式：[时间戳] [类型]: [数据1]：[值1]，[数据2]：[值2]，...
     * @return array
     */
/*     public function logToArray()
    {
        $data = [];
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
            if (preg_match('/\[(.*?)\] INFO: (.*)/', $line, $matches)) {
                $timestamp = $matches[1]; // 时间戳
                $logData = $matches[2];   // 日志数据部分

                // 解析日志数据部分
                $dataPairs = explode('，', $logData);
                $logEntry = ['timestamp' => $timestamp];

                foreach ($dataPairs as $pair) {
                    list($key, $value) = explode('：', $pair, 2);
                    $logEntry[trim($key)] = trim($value);
                }

                // 将解析后的日志条目添加到结果数组中
                $result[] = $logEntry;
            }
        }

        return $result;
    } */
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
            if (preg_match('/\[(.*?)\] (\w+): (.*)/', $line, $matches)) {
                $timestamp = $matches[1];  // 时间戳
                $type = $matches[2];        // 日志类型（比如 INFO）
                $logData = $matches[3];     // 日志数据部分
    
                // 解析日志数据部分
                $dataPairs = explode('，', $logData);
                $logEntry = ['timestamp' => $timestamp, 'type' => $type];  // 添加 type
    
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
        var_dump($result);
    
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

        $allData = $this->logToArray();//获取全部日志数据
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
        //todo:测试
        $pageData = $this->logByPage();
        $logData = $pageData[$id - 1];
        $data = [];
        $data['data'] = $logData;
        $data['code'] = 0;
        return $data;
    }
    /**
     * 下载日志文件
     * @return void
     */
    public function downloadLog()
    {
        //todo:测试
        $logText = file_get_contents($this->logFile);
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$this->logFileName);
        echo $logText;
        exit();
    }

    /**
     * 删除一条日志内容
     * @param int $id 日志ID
     * @return void
     */
    public function logDelete($id)
    {
        //todo:测试
        $pageData = $this->logByPage();
        $logData = $pageData[$id - 1];
        $logText = file_get_contents($this->logFile);
        $logLines = explode("\n", $logText);
        $newLogLines = [];
        foreach ($logLines as $line) {
            if (empty(trim($line))) {
                continue;
            }
            if (preg_match('/\[(.*?)\] INFO: (.*)/', $line, $matches)) {
                $timestamp = $matches[1]; // 时间戳
                $logData = $matches[2];   // 日志数据部分
                $dataPairs = explode('，', $logData);
                $logEntry = ['timestamp' => $timestamp];
                foreach ($dataPairs as $pair) {
                    list($key, $value) = explode('：', $pair, 2);
                    $logEntry[trim($key)] = trim($value);
                }
                if ($logEntry['id'] != $id) {
                    $newLogLines[] = $line;
                }
            }
        }
        $newLogText = implode("\n", $newLogLines);
        file_put_contents($this->logFile, $newLogText);
    }

    /**
     * 清空日志文件内容
     * @return void
     */
    public function clearLog()
    {
        //todo:测试
        file_put_contents($this->logFile, '');
    }
}
