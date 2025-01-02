<?php

namespace App\Http\Response;

/**
 * Summary of Responce
 * 响应类
 * @author <eogee.com> <<eogee@qq.com>>
 */
class Responce {
    /**
     * Summary of responce
     * 响应数据
     */
    public static function responce($data)
    {
        // 验证输入数据的有效性
        if (!is_array($data)) {
            return; // 如果数据不是数组，直接返回，避免后续错误
        }

        // 设置响应头部为 JSON 格式
        header('Content-Type: application/json');

        // 将数组编码为 JSON，并处理编码错误
        $jsonResponse = json_encode($data);
        if ($jsonResponse === false) {
            // 处理 json_encode 错误
            echo json_encode(['code' => 1, 'msg' => 'JSON 编码错误']);
            return;
        }

        // 输出 JSON 响应
        echo $jsonResponse;
    }
}