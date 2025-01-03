<?php

namespace Easy\Cache;

use Helper\Path;

/**
 * Summary of Cache
 * 缓存类
 * @author <eogee.com> <<eogee@qq.com>>
 */
class Cache {
    protected $dir;
    
    public function __construct() {
        $this->dir = Path::rootPath() . CONFIG['cache']['cache_path'];
        if (!is_dir($this->dir)) {
            if (!mkdir($this->dir, 0777, true)) {
                die("无法创建缓存目录: {$this->dir}");
            }
        }
    }

    /**
     * 设置缓存
     * @param string $fileName 缓存文件名
     * @param mixed $value 缓存值
     * @param int $expire 缓存过期时间（秒），0 表示永不过期
     */
    public function set($fileName, $value, $expire = 0) {
        $cacheFile = $this->getCacheFilePath($fileName);

        // 检查目录是否可写
        if (!is_writable($this->dir)) {
            die("缓存目录不可写: {$this->dir}");
        }

        // 添加过期时间
        $data = [
            'expire' => $expire > 0 ? time() + $expire : 0,
            'data' => $value
        ];

        // 写入缓存文件
        $result = file_put_contents($cacheFile, serialize($data));
        if ($result === false) {
            die("无法写入缓存文件: {$cacheFile}");
        }
    }

    /**
     * 获取缓存
     * @param string $fileName 缓存文件名
     * @return mixed|false 缓存数据，如果缓存不存在或已过期则返回 false
     */
    public function get($fileName) {
        $cacheFile = $this->getCacheFilePath($fileName);

        if (file_exists($cacheFile)) {
            $data = unserialize(file_get_contents($cacheFile));
            if ($this->isCacheValid($data)) {
                return $data['data'];
            } else {
                // 缓存已过期，删除文件
                $this->delete($fileName);
            }
        }
        return false;
    }

    /**
     * 删除缓存
     * @param string $fileName 缓存文件名
     * @return bool 是否删除成功
     */
    public function delete($fileName) {
        $cacheFile = $this->getCacheFilePath($fileName);
        if (file_exists($cacheFile)) {
            return unlink($cacheFile);
        }
        return false;
    }

    /**
     * 判断缓存是否存在
     * @param string $fileName 缓存文件名
     * @return bool
     */
    public function has($fileName) {
        $cacheFile = $this->getCacheFilePath($fileName);
        return file_exists($cacheFile) && $this->isCacheValid(unserialize(file_get_contents($cacheFile)));
    }

    /**
     * 获取缓存文件路径
     * @param string $fileName 缓存文件名
     * @return string
     */
    protected function getCacheFilePath($fileName) {
        // 防止路径遍历攻击
        $fileName = str_replace(['/', '\\'], '', $fileName);
        return $this->dir . '/' . $fileName . '.cache';
    }

    /**
     * 检查缓存是否有效
     * @param array $data 缓存数据
     * @return bool
     */
    protected function isCacheValid($data) {
        if (!isset($data['expire'], $data['data'])) {
            return false;
        }
        return $data['expire'] === 0 || $data['expire'] > time();
    }
}
