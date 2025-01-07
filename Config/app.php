<?php

/**
 * Application configuration
 * 应用配置
 * @author Eogee
 * @email eogee@qq.com 
 */
return [
    //站点名称
    'name' => 'eogee',

    //站点URL
    'url' => 'http://eogee.com',

    //开发者模式
    'developer_mode'=>false,//开发者模式，开启后将显示错误信息
    
    //测试环境IP地址
    'test_env_ip'=>'111.227.244.105',//测试环境IP地址

    //Catpcha验证码字体
    'captcha_enable' => true,
    'captcha_font' => 'framd.ttf',
    'captcha_font_size' => 16,
];