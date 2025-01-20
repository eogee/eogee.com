<!DOCTYPE html>
<html>
<head>
    <title>详情显示</title>
    <link rel="stylesheet" href="/layui/css/layui.css">
    <?= CONFIG['app']['dark_theme'] ?"<link rel='stylesheet' href='/css/eogee-admin-dark.css'>" : null?>
    <link rel="stylesheet" href="/css/eogee-admin.css> 
    <script src="/layui/layui.js"></script>
    <script src="/js/admin/eogee-admin-layui.js"></script>
</head>
<body>
    <div style="padding: 10px 10px 35px 10px;">
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
            <tbody id = "tbody">
            </tbody>
        </table>
    </div>
    <script>
        ajax('/'+modelName+'/'+pageName+'Api/'+tableId,false,function(response) {
            tableData = JSON.parse(response);
        });
        renderShowTable(tableData);
    </script>
</body>
</html>