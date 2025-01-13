<?php

/**
 * Summary of env
 * 环境变量文件加载函数
 * @param string $envFile 环境变量文件路径，默认为.env
 * @return void
 */
function env($envFile = null)
{
    // 定义全局变量
    global $_ENV;

    // 环境变量文件
    if (empty($envFile)) {
        $envFile = __DIR__. '/../.env';
    }else{
        $envFile = __DIR__. '/../'. $envFile;
    }

    // 读取环境变量文件
    if (file_exists($envFile)) {

        $content = file_get_contents($envFile);
        if ($content === false) {
            echo "无法读取文件内容";
        } else {
            $lines = explode("\n", $content);
        }
        foreach ($lines as $line) {

            // 忽略空行和注释
            $line = trim($line);
            
            if ($line) {
                // 忽略以 # 开头的注释行
                if (strpos($line, '#') !== 0) {
                    // 确保行中包含 '=' 符号
                    if (strpos($line, '=') !== false) {
                        list($key, $value) = explode('=', $line, 2);
                        $key = trim($key);
                        $value = trim($value);
                        
                        // 去除值两边的引号
                        $value = trim($value, '"\'');

                        // 处理布尔值
                        if (strcasecmp($value, 'true') === 0) {
                            $value = true;
                        } elseif (strcasecmp($value, 'false') === 0) {
                            $value = false;
                        }
                        
                        putenv("$key=$value"); // 设置环境变量
                        $_ENV[$key] = $value;  // 同时设置 $_ENV 中的变量
                    }
                }
            }            
        }
    } else {
        
        // 环境变量文件不存在
        trigger_error("Warning: {$envFile} file not found.", E_USER_WARNING);
    }
}
