<?php

namespace Easy\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail {
    private $mail;// 邮件对象
    private $smtpHost = CONFIG['mail']['smtpHost'];// SMTP 服务器
    private $username = CONFIG['mail']['username'];// SMTP 用户名
    private $password = CONFIG['mail']['password'];// SMTP 密码(授权码)
    private $port = CONFIG['mail']['port'];// SMTP 端口
    private $email = CONFIG['mail']['email'];// 发件人邮箱
    private $subject = CONFIG['mail']['default_subject'];// 邮件主题

    public function __construct() {
        $this->mail = new PHPMailer(true);
        
        // 服务器设置
        $this->mail->isSMTP();
        $this->mail->Host       = $this->smtpHost; // SMTP 服务器
        $this->mail->SMTPAuth   = true;       // 启用 SMTP 身份验证
        $this->mail->Username   = $this->username;  // 发件人邮箱
        $this->mail->Password   = $this->password;  // 发件人邮箱密码
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // 加密方式
        $this->mail->Port       = $this->port;      // SMTP 端口
    }

    /**
     * Summary of setFrom
     * 设置发件人
     * @return void
     */
    public function setFrom() {
        $this->mail->setFrom($this->email, $this->username);
    }

    /**
     * Summary of addRecipient
     * 添加收件人
     * @param string $email 收件人邮箱
     * @param string $name 收件人姓名
     * @return void
     */
    public function addRecipient($email, $name) {
        $this->mail->addAddress($email, $name);
    }

    /**
     * Summary of setSubject
     * 设置邮件主题
     * @param string $subject 邮件主题
     * @return void
     */
    public function setSubject($subject = null) {
        if(!empty($subject)) {
            $this->mail->Subject = $subject;
        }
        $this->mail->Subject = $this->subject;
    }

    /**
     * Summary of setBody
     * 设置邮件内容
     * @param string $htmlContent HTML内容
     * @param string $altContent 纯文本内容
     * @return void
     */
    public function setBody($htmlContent, $altContent) {
        $this->mail->isHTML(true); // 设置邮件格式为HTML
        $this->mail->Body    = $htmlContent;   // HTML 邮件内容
        $this->mail->AltBody = $altContent;     // 纯文本内容
    }

    /**
     * Summary of send
     * 发送邮件
     * @return bool 发送成功返回true，发送失败返回false
     */
    public function send( $htmlContent, $altContent, $email, $name, $subject = null) {
        $this->setFrom();
        $this->setSubject($subject = null);
        $this->setBody($htmlContent, $altContent);
        $this->addRecipient($email, $name);
        try {
            $this->mail->send();
            return true; // 发送成功
        } catch (Exception $e) {
            echo "邮件发送失败。错误信息: {$this->mail->ErrorInfo}"; // 错误信息
            return false; // 发送失败
        }
    }
}
