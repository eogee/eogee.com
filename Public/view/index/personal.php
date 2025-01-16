<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>个人中心</title>
    <link rel="stylesheet" href="/layui/css/layui.css">
    <script src="/layui/layui.js"></script>
    <script src="/js/admin/eogee-admin-layui.js"></script>
</head>

<body>
    <div class="layui-container">
        <br><br>
        <button id = "logout" class="layui-btn layui-btn-primary">退出登录</button> <br><br>
    </div>

    <script>
        layui.use( function () {
            var layer = layui.layer;

            // 退出登录按钮点击事件
            document.getElementById('logout').onclick = function() {
                fetch('/index/logout', {
                    method: 'POST', // 假设 logout 接口需要 POST 请求
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    credentials: 'include' // 包含 cookie
                })
                .then(response => response.json())
                .then(data => {
                    if (data.code === 0) {
                        layer.msg('退出登录成功', {
                            icon: 1,
                            time: 1000 // 1秒后自动关闭
                        });
                        setTimeout(function() {
                            // 刷新当前页面
                            window.parent.layer.closeAll(); // 关闭所有弹窗
                        }, 1000);
                    } else {
                        layer.msg('退出登录失败', {
                            icon: 5,
                            time: 1000
                        });
                    }
                })
                .catch(error => {
                    console.error('退出登录请求失败:', error);
                    layer.msg('退出登录请求失败', {
                        icon: 5,
                        time: 2000
                    });
                });
            };
        });
    </script>
</body>
</html>
