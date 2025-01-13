<?php

use Helper\Window;

/**
 * 自定义错误处理函数
 * @param int $errNo 错误码
 * @param string $errStr 错误信息
 * @return void
 */
function error($errNo, $errStr) 
{
    Window::alert("发生错误：[$errNo] $errStr ");#弹窗显示错误内容
    die();
}
// 全局使用
set_error_handler("error");