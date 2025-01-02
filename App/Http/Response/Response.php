<?php

namespace App\Http\Response;

/**
 * Summary of Response
 * 响应类
 * @author eogee.com <<eogee@qq.com>>
 */
class Response
{
    /**
     * 设置 HTTP 状态码
     * @param int $code 状态码
     */
    public static function status(int $code)
    {
        http_response_code($code);
    }
    /**
     * 设置响应头
     * @param string $key 头名称
     * @param string $value 头值
     */
    public static function header(string $key, string $value)
    {
        header("$key: $value");
    }
    /**
     * 返回 JSON 数据
     * @param array $data 数据
     * @return void
     */
    public static function json(array $data)
    {
        self::header('Content-Type', 'application/json');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }
    /**
     * 返回文本数据
     * @param string $text 文本内容
     * @return void
     */
    public static function text(string $text)
    {
        self::header('Content-Type', 'text/plain');
        echo $text;
        exit;
    }
    /**
     * 返回 HTML 数据
     * @param string $html HTML 内容
     * @return void
     */
    public static function html(string $html)
    {
        self::header('Content-Type', 'text/html');
        echo $html;
        exit;
    }
    /**
     * 重定向到指定 URL
     * @param string $url 目标 URL
     * @param int $statusCode 状态码（默认 302）
     * @return void
     */
    public static function redirect(string $url, int $statusCode = 302)
    {
        self::status($statusCode);
        self::header('Location', $url);
        exit;
    }
    /**
     * 返回文件下载
     * @param string $filePath 文件路径
     * @param string|null $fileName 下载文件名（可选）
     * @return void
     */
    public static function download(string $filePath, ?string $fileName = null)
    {
        if (!file_exists($filePath)) {
            self::status(404);
            self::text('File not found');
            exit;
        }

        $fileName = $fileName ?? basename($filePath);
        self::header('Content-Type', 'application/octet-stream');
        self::header('Content-Disposition', "attachment; filename=\"$fileName\"");
        self::header('Content-Length', filesize($filePath));

        readfile($filePath);
        exit;
    }
}
