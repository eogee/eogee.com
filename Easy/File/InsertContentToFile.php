<?php

namespace Easy\File;

class InsertContentToFile
{
    /**
     * 后置写入文件内容
     * @param string $filename 文件名
     * @param string $searchContent 查找的内容     * 
     * @param string $newContent 新插入的内容
     * @return bool
     */
    function insertContentAfter($filename, $searchContent, $newContent) {
        // 读取文件内容
        $fileContent = $this->readFileContent($filename);
        // 查找插入点（$searchContent 的结束位置）
        $insertPos = strpos($fileContent, $searchContent);
        
        if ($insertPos !== false) {
            $insertPos += strlen($searchContent); // 移动到 $searchContent 的结束位置
            // 插入新内容
            $newFileContent = substr_replace($fileContent, $newContent, $insertPos, 0);
            // 写回文件
            if (file_put_contents($filename, $newFileContent) !== false) {
                echo "Content inserted successfully in file '$filename'.\n";
                return true;
            } else {
                echo "Failed to write to file '$filename'.\n";
                return false;
            }
        } else {
            echo "'$searchContent' not found in file '$filename'.\n";
            return false;
        }
    }
    
    /**
     * 前置写入文件内容
     * @param string $filename 文件名
     * @param string $searchContent 查找的内容
     * @param string $newContent 新插入的内容
     * @return bool
     */
    public function insertContentBefore($filename, $searchContent, $newContent) {
        // 读取文件内容
        $fileContent = $this->readFileContent($filename);
        // 查找插入点（$searchContent 的起始位置）
        $insertPos = strpos($fileContent, $searchContent);
        
        if ($insertPos !== false) {
            // 插入新内容
            $newFileContent = substr_replace($fileContent, $newContent, $insertPos, 0);
            // 写回文件
            if (file_put_contents($filename, $newFileContent) !== false) {
                echo "Content inserted successfully in file '$filename'.\n";
                return true;
            } else {
                echo "Failed to write to file '$filename'.\n";
                return false;
            }
        } else {
            echo "'$searchContent' not found in file '$filename'.\n";
            return false;
        }
    }
    

    /**
     * 读取文件内容
     * @param string $filename 文件名
     * @return bool|string
     */
    public function readFileContent($filename) {
        $content = file_get_contents($filename);
        if ($content === false) {
            echo "Failed to read file '$filename'.\n";
            return false;
        }
        return $content;
    }

    /**
     * 查找插入点
     * @param string $fileContent 文件内容
     * @param string $searchContent 要查找的内容
     * @return bool|int
     */
    public function insertPos($fileContent, $searchContent, $isAfter = true) {
        // 查找插入点
        $pos = strpos($fileContent, $searchContent);
        if ($pos === false) {
            echo "Content '$searchContent' not found.\n";
            return false;
        }
        // 计算插入位置
        if ($isAfter) {
            $pos += strlen($searchContent);
        }
        return $pos;
    }

}