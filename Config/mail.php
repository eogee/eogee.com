<?php

/**
 * Mail configuration
 * 邮箱配置
 */
return [
    //SMTP服务器地址
    'smtpHost' => getenv('MAIL_HOST'),

    //发件人邮箱
    'username' => getenv('MAIL_USERNAME'),
    
    //SMTP服务器端口
    'port' => getenv('MAIL_PORT'),

    
    //发件人邮箱密码（授权码）
    'password' => getenv('MAIL_PASSWORD'),
    
    //发件人邮箱
    'email' => getenv('MAIL'),
    
    //发件人名称
    'name' => getenv('MAIL_NAME'),
    
    //邮件主题
    'default_subject' => getenv('MAIL_SUBJECT'),
];