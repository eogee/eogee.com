<?php

namespace Easy\Verify;

use Helper\Window;

/**
 * 验证类
 * @author Eogee
 * @email eogee@qq.com
 */
class Verify
{    
    protected $data; // 存储表单数据    
    protected $rules; // 存储验证规则   
    protected $errors; // 存储错误信息
    public function __construct()
    {
        $this->data = [];
        $this->rules = [];
        $this->errors = [];
    }

    /**
     * 后台访问限制
     * @return void
     */
    public static function adminLimit()
    {
        if(!isset($_SESSION['username'])){
            Window::redirect('/auth/login');//判断是否登录
            die();
        }
        
        if($_SESSION['user_identity'] !== '管理员'){
            Window::redirect('/auth/login');//判断是否为管理员
            die();
        }
    }
    /**
     * CSRF 验证
     * @return void
     */
    public static function crsfVerify()
    {
        if(empty($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf_token']) {
            die('CSRF attack detected!');
        }else{
            unset($_POST['csrf']);
        }
    }
    /**
     * 设置表单数据
     * @param array $data 表单数据
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * 设置验证规则
     * @param array $rules 验证规则
     */
    public function setRules(array $rules)
    {
        $this->rules = $rules;
    }

    /**
     * 验证表单数据
     * @return bool 是否验证通过
     */
    public function validate(array $data)
    {   
        $this->setData($data);//设置表单数据
        
        $this->errors = []; // 清空之前的错误信息

        foreach ($this->rules as $field => $rule) {
            $value = $this->data[$field] ?? null;

            // 遍历规则并验证
            foreach ($rule as $ruleName => $ruleValue) {
                $method = 'validate' . ucfirst($ruleName); // 动态调用验证方法
                if (method_exists($this, $method)) {
                    if (!$this->$method($field, $value, $ruleValue)) {
                        break; // 如果验证失败，跳出当前字段的规则循环
                    }
                } else {
                    throw new \Exception("'$ruleName'的表单验证不通过！");
                }
            }
        }
        
        return empty($this->errors); // 如果没有错误，返回 true
    }

    /**
     * 获取错误信息
     * @return array 错误信息
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * 添加错误信息
     * @param string $field 字段名
     * @param string $message 错误信息
     */
    protected function addError($field, $message)
    {
        $this->errors[$field][] = $message;
    }

    /**
     * 验证必填字段
     * @param string $field 字段名
     * @param mixed $value 字段值
     * @param bool $required 是否必填
     * @return bool 是否验证通过
     */
    protected function validateRequired($field, $value, $required)
    {
        if ($required && empty($value)) {
            $this->addError($field, "$field 为必填项！");
            return false;
        }
        return true;
    }

    /**
     * 验证最小长度
     * @param string $field 字段名
     * @param mixed $value 字段值
     * @param int $minLength 最小长度
     * @return bool 是否验证通过
     */
    protected function validateMinLength($field, $value, $minLength)
    {
        if (strlen($value) < $minLength) {
            $this->addError($field, "$field 的长度不得小于 $minLength 字节！");
            return false;
        }
        return true;
    }

    /**
     * 验证最大长度
     * @param string $field 字段名
     * @param mixed $value 字段值
     * @param int $maxLength 最大长度
     * @return bool 是否验证通过
     */
    protected function validateMaxLength($field, $value, $maxLength)
    {
        if (strlen($value) > $maxLength) {
            $this->addError($field, "$field 的长度不得超过 $maxLength 字节！");
            return false;
        }
        return true;
    }

    /**
     * 验证正则表达式
     * @param string $field 字段名
     * @param mixed $value 字段值
     * @param string $pattern 正则表达式
     * @return bool 是否验证通过
     */
    protected function validateRegex($field, $value, $pattern)
    {
        if (!preg_match($pattern, $value)) {
            $this->addError($field, "$field 格式不正确！");
            return false;
        }
        return true;
    }
    /**
     * Summary of validateUnique
     * 验证唯一性
     * @param mixed $field
     * @param mixed $value
     * @param mixed $tableName
     * @return bool
     */
    protected function validateUnique($field, $value, $tableName)
    {
        // 连接数据库
        $mysql = new \mysqli(CONFIG['database']['host'], CONFIG['database']['user'], CONFIG['database']['password'], CONFIG['database']['name']);

        // 检查连接是否成功
        if ($mysql->connect_error) {
            die("连接失败: " . $mysql->connect_error);
        }
        $sql = "SELECT * FROM $tableName WHERE $field = ?";
        $stmt = $mysql->prepare($sql);

        // 绑定参数
        $stmt->bind_param("s", $value);

        // 执行查询
        $stmt->execute();

        // 获取结果
        $result = $stmt->get_result();

        // 检查是否有结果
        if ($result->num_rows > 0) {
            $this->addError($field, "$field 已存在！");
            return false;
        }

        // 关闭连接
        $stmt->close();
        $mysql->close();

        return true;

    }

    // 验证是否存在
    protected function validateExists($field, $value, $tableName)
    {
        // 连接数据库
        $mysql = new \mysqli(CONFIG['database']['host'], CONFIG['database']['user'], CONFIG['database']['password'], CONFIG['database']['name']);

        // 检查连接是否成功
        if ($mysql->connect_error) {
            die("连接失败: " . $mysql->connect_error);
        }
        $sql = "SELECT * FROM $tableName WHERE $field = ?";
        $stmt = $mysql->prepare($sql);

        // 绑定参数
        $stmt->bind_param("s", $value);

        // 执行查询
        $stmt->execute();

        // 获取结果
        $result = $stmt->get_result();

        // 检查是否有结果
        if ($result->num_rows < 1) {
            $this->addError($field, "$field 不存在！");
            return false;
        }

        // 关闭连接
        $stmt->close();
        $mysql->close();

        return true;
    }

    /**
     * Summary of validateEqual
     * 验证两个字段是否相等
     * @param mixed $field
     * @param mixed $value
     * @param mixed $equalField
     * @return bool
     */
    protected function validateEqual($field, $value, $equalField)
    {
        if ($value !== $this->data[$equalField]) {
            $this->addError($field, "$field 与 $equalField 不匹配！");
            return false;
        }
        return true;
    }

    // 验证与session中的值是否一致
    protected function validateSession($field, $value, $sessionName)
    {
        if ($value !== $_SESSION[$sessionName]) {
            $this->addError($field, "$field 与 $sessionName 不匹配！");
            return false;
        }
        return true;
    }
}
