<?php

namespace Easy\Request;

/**
 * Summary of Request
 * 请求类
 * @author Eogee
 * @email eogee@qq.com 
 */
class Request
{
    /**
     * 获取当前请求的方法（GET、POST 等）
     * @return string
     */
    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * 判断当前请求是否为 GET 请求
     * @return bool
     */
    public function isGet()
    {
        return $this->method() === 'GET';
    }

    /**
     * 判断当前请求是否为 POST 请求
     * @return bool
     */
    public function isPost()
    {
        return $this->method() === 'POST';
    }

    /**
     * 获取 GET 请求参数
     * @param string $key 参数名
     * @return mixed|null
     */
    public function get($key)
    {
        return $_GET[$key] ?? null;
    }

    /**
     * 获取请求参数（GET 或 POST）
     * @param string $key 参数名
     * @param mixed $default 默认值
     * @return mixed
     */
    public function input($key, $default = null)
    {
        $input = $this->getInputData();
        return $input[$key] ?? $default;
    }
    /**
     * 获取所有请求参数
     * @return array
     */
    public function all()
    {
        return $this->getInputData();
    }
    /**
     * 获取除指定字段外的所有请求参数
     * @param array $excludedFields 要过滤的字段
     * @return array
     */
    public function allExc(array $excludedFields = ['file','editormd-image-file'])
    {
        $input = $this->all();

        // 过滤敏感字段
        foreach ($excludedFields as $field) {
            unset($input[$field]);
            unset($_FILES[$field]); // 同时过滤 $_FILES 中的字段
        }

        return $input;
    }    
    /**
     * 获取请求体数据
     * @return array
     */
    protected function getInputData()
    {
        if ($this->isJson()) {
            return json_decode(file_get_contents('php://input'), true) ?? [];
        }
    
        switch ($this->method()) {
            case 'GET':
                return $_GET;
            case 'POST':
                return array_merge($_POST, $_FILES);
            case 'PUT':
            case 'DELETE':
                parse_str(file_get_contents('php://input'), $input);
                return $input;
            default:
                return [];
        }        
    }
    
    /**
     * 判断是否为 JSON 请求
     * @return bool
     */
    public function isJson()
    {
        $contentType = $this->header('Content-Type');
        return $contentType && strpos($contentType, 'application/json') !== false;
    }    
    /**
     * 获取请求头
     * @param string $key 头名称
     * @return string|null
     */
    public function header($key)
    {
        if (function_exists('getallheaders')) {
            $headers = getallheaders();
        } else {
            $headers = [];
            foreach ($_SERVER as $name => $value) {
                if (strpos($name, 'HTTP_') === 0) {
                    $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
                }
            }
        }
        return $headers[$key] ?? null;
    }
    /**
     * 获取当前请求的 URL
     * @return string
     */
    public function url()
    {
        return strtok($_SERVER['REQUEST_URI'], '?');
    }
    /**
     * 获取当前请求的主机名
     * @return string
     */
    public function host()
    {
        return $_SERVER['HTTP_HOST'];
    }

    /**
     * 获取当前请求的 IP 地址
     * @return string
     */
    public function ip()
    {
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }
        return $_SERVER['REMOTE_ADDR'];
    }    
    /**
     * 获取当前请求的用户代理（User-Agent）
     * @return string
     */
    public function userAgent()
    {
        return $_SERVER['HTTP_USER_AGENT'] ?? '';
    }
}

