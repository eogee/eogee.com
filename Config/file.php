<?php

/**
 * File configuration
 * 文件上传配置
 */
return [
    //图片上传路径
    'pic_upload_path' => 'pic/',

    //文件上传路径
    'file_upload_path' => 'file/',

    //图片上传路径
    'user_pic_upload_path' => 'upload/pic/',

    //文件上传路径
    'user_file_upload_path' => 'upload/file/',

    //允许上传的文件类型
    'allowed_types' => 'gif|jpg|png|jpeg|pdf|doc|docx|xls|xlsx|ppt|pptx|txt',
    
    //允许上传的文件大小
    'max_size' => 1024 * 1024, //1MB

    //默认composer资源路径
    'composer_dir_name' => 'vendor/',

    //默认npm资源路径
    'module_dir_name' => 'node_modules/',

    //默认dist资源路径
    'dist_dir_name' => 'Public/dist/',

];