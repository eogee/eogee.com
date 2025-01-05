<?php

namespace Easy\Log;

/**
 * Summary of Log
 * 日志类
 * @author eogee eogee@qq.com
 */
class Log
{
    private $logFile;
    private $logToConsole;

    /**
     * Logger constructor.
     * @param string $logFile 日志文件路径
     * @param bool $logToConsole 是否将日志输出到控制台
     */
    public function __construct()
    {
        $this->logFile = __DIR__ . '/../../'.CONFIG['log']['log_path'].'/'.CONFIG['log']['log_file'];
        $this->logToConsole = CONFIG['log']['log_to_console'];
    }

    /**
     * 记录信息日志
     * @param string $message 日志信息
     */
    public function info($message)
    {
        $this->log('INFO', $message);
    }

    /**
     * 记录错误日志
     * @param string $message 日志信息
     */
    public function error($message)
    {
        $this->log('ERROR', $message);
    }

    /**
     * 记录警告日志
     * @param string $message 日志信息
     */
    public function warning($message)
    {
        $this->log('WARNING', $message);
    }

    /**
     * 记录调试日志
     * @param string $message 日志信息
     */
    public function debug($message)
    {
        $this->log('DEBUG', $message);
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
}
