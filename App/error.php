<?php
/*错误处理文件 */
use Model\Model;

// 错误处理提示函数
function error($errNo, $errStr) 
{
    Model::alert("发生错误：[$errNo] $errStr 请点击确认返回至上一页",'back');#弹窗显示错误内容
    die();
}
// 全局使用
set_error_handler("error");