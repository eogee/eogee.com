<?php

namespace Easy\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail {
    private $mail;

    public function __construct($smtpHost, $username, $password, $port = 587, $encryption = PHPMailer::ENCRYPTION_STARTTLS) {
        $this->mail = new PHPMailer(true);
        
        // 服务器设置
        $this->mail->isSMTP();
        $this->mail->Host       = $smtpHost; // SMTP 服务器
        $this->mail->SMTPAuth   = true;       // 启用 SMTP 身份验证
        $this->mail->Username   = $username;  // 发件人邮箱
        $this->mail->Password   = $password;  // 发件人邮箱密码
        $this->mail->SMTPSecure = $encryption; // 加密方式
        $this->mail->Port       = $port;      // SMTP 端口
    }

    public function setFrom($email, $name) {
        $this->mail->setFrom($email, $name);
    }

    public function addRecipient($email, $name) {
        $this->mail->addAddress($email, $name);
    }

    public function setSubject($subject) {
        $this->mail->Subject = $subject;
    }

    public function setBody($htmlContent, $altContent) {
        $this->mail->isHTML(true); // 设置邮件格式为HTML
        $this->mail->Body    = $htmlContent;   // HTML 邮件内容
        $this->mail->AltBody = $altContent;     // 纯文本内容
    }

    public function send() {
        try {
            $this->mail->send();
            return true; // 发送成功
        } catch (Exception $e) {
            echo "邮件发送失败。错误信息: {$this->mail->ErrorInfo}"; // 错误信息
            return false; // 发送失败
        }
    }
}
