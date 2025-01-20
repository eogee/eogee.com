<?php

/**
 * Application configuration
 * 应用配置
 * @author Eogee
 * @email eogee@qq.com 
 */
return [
    //站点名称
    'name' => getenv('APP_NAME'),

    //站点URL
    'url' => getenv('APP_URL'),

    //Catpcha图形验证码
    'captcha_enable' => true,//是否开启验证码
    'captcha_font' => 'framd.ttf',//验证码字体
    'captcha_font_size' => 16,//验证码字体大小

    //开发者模式
    'developer_mode'=>getenv('DEVALOPMENT_MODE'),//开发者模式，开启后将显示错误信息
    
    //测试环境IP地址
    'test_env_ip'=>'111.227.244.105',//测试环境IP地址

    //暗夜主题
    'dark_theme' => true,//是否开启
];