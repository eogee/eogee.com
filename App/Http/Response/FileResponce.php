<?php

namespace App\Http\Response;

/**
 * 文件响应类
 * @author <eogee.com> <<eogee@qq.com>>
 */
class FileResponce
{
    /**
     * 文件上传成功响应
     * @code int 响应状态码
     * @param string $message 响应消息  
     * @return void
     */
    public static function upload($code, $message)
    {       
        $response = [
            'code' => $code,
           'message' => $message
        ];
        // 设置响应头部为 JSON 格式
        header('Content-Type: application/json');
        echo json_encode($response); // 输出 JSON 响应
    }
}

