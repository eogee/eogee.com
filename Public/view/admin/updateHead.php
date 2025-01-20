<!DOCTYPE html>
<html>
<head>
    <title>更新数据</title>
    <link rel="stylesheet" href="/layui/css/layui.css" rel="stylesheet">
    <?= CONFIG['app']['dark_theme'] ?"<link rel='stylesheet' href='/css/eogee-admin-dark.css' rel='stylesheet'>" : null?>
    <link rel="stylesheet" href="/css/eogee-admin.css" rel="stylesheet">
    <script src="/layui/layui.js"></script>
    <script src="/js/admin/eogee-admin-layui.js"></script>
</head>
<body>
    <div style="padding: 10px 10px 35px 10px;">
        <form class = "layui-form" method = "post" lay-filter = "form" id = "form">
        <table class = "layui-table">
            <colgroup>
                <col width="110">
            </colgroup>
            <thead>
                <tr>
                    <th>项目</th>
                    <th>内容</th>
                </tr>
            </thead>
            <tbody>
                <input id = "hiddenId" type="hidden" name="id">
                <!-- crsf令牌 -->
                <input id = "csrf_token" type="hidden" name="csrf">
                <tr id="id">
                    <td></td>
                    <td></td>
                </tr>