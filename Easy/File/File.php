<?php
namespace Easy\File;

use Easy\Database\Database;
use Helper\Url;

/**
 * Summary of File
 * 文件操作类
 * @author Eogee
 * @email eogee@qq.com 
 */
class File
{
    protected $db;

    protected $picPath = CONFIG['file']['pic_upload_path'];

    protected $filePath = CONFIG['file']['file_upload_path'];

    public function __construct()
    {
        $this->db = Database::getInstance();
    }
    /**
     * Summary of fileUploadApi
     * 文件上传api接口
     * @param string|null $table 表名
     * @param string|null $fileName 文件名
     * @param string $type 文件类型（默认 'pic'）
     * @param int|null $id 记录ID
     * @return array 返回上传结果
     */
    public function fileUploadApi($table = null, $fileName = null, $type = 'pic', $id = null)
    {
        if ($type == 'pic') {
            $dir = $this->picPath;
        } else {
            $dir = $this->filePath;
        }

        // 获取 ID，并确保其存在
        $id = Url::getId() ?: 1;

        // 确保表名有效
        if (empty($table)) {
            $table = Url::getTable();
        }

        // 确保文件名有效
        if (empty($fileName) && isset($_POST['fileName'])) {
            $fileName = $_POST['fileName'];
        }

        // 验证上传的文件
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = rtrim($dir, '/') . '/'; // 确保路径格式正确
            $tmpName = $_FILES['file']['tmp_name']; // 获取文件的临时路径
            $name = basename($_FILES['file']['name']); // 防止路径注入，确保文件名安全

            // 获取旧文件路径
            $oldFileStr = $this->db->select($table, "WHERE id = $id")[0][$fileName] ?? null;
            $oldFile = ltrim($oldFileStr, '/'); // 去除开头的斜杠

            // 删除旧文件
            if ($oldFile && file_exists($oldFile)) {
                unlink($oldFile); // 删除现有文件
            }

            // 移动上传的文件到目标目录
            if (move_uploaded_file($tmpName, $uploadDir . $name)) {
                // 准备数据库更新数据
                $data = [
                    $fileName => '/' . $uploadDir . $name // 记录新文件路径
                ];
                $this->db->update($table, $data, "WHERE id = $id"); // 更新数据库记录

                $code = 0;
                $msg = "上传成功！";
            } else {
                $code = 100;
                $msg = "文件移动失败！";
            }
        } else {
            $code = 100;
            $msg = "上传失败！错误代码：" . ($_FILES['file']['error'] ?? '未知错误');
        }

        return [
            'code' => $code,
            'msg' => $msg
        ];
    }

    /**
     * Summary of getCurrentFileName
     * 获取当前文件名（不含后缀）
     * @return string
     */
    public function getCurrentFileName()
    {
        return pathinfo(__FILE__, PATHINFO_FILENAME);
    }
}
