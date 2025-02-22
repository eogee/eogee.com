<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>登录EOGEE</title>
    <link rel="stylesheet" href="/layui/css/layui.css">
    <link rel="stylesheet" href="/css/auth.css">
    <script src="/layui/layui.js"></script>
    <script src="/js/admin/eogee-admin-layui.js"></script>
</head>

<body>
    <div class="layui-row layui-hide layui-show-md-block layui-show-sm-block" style="height: 100px"></div>
    <div class="layui-row">
        <div class="layui-col-xs12 layui-col-sm4 layui-col-md4" style="height: 50px"></div>
        <div class="layui-col-xs12 layui-col-sm4 layui-col-md4">
            <img src="<?=$data?>" alt="EOGEE" class="logo">
            <form class="layui-form" id="form" method="post">
                <div class="demo-login-container">
                    <div class="layui-form-item">
                        <div class="layui-input-wrap">
                            <div class="layui-input-prefix">
                                <i class="layui-icon layui-icon-username"></i>
                            </div>
                            <input type="text" name="username" placeholder="请输入用户名或注册邮箱" class="layui-input" lay-verify="required|username">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-wrap">
                            <div class="layui-input-prefix">
                                <i class="layui-icon layui-icon-password"></i>
                            </div>
                            <input type="password" name="password" placeholder="请输入密码" class="layui-input" lay-affix="eye" lay-verify="required|password">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-row">
                            <div class="layui-col-xs8">
                                <div class="layui-input-wrap">
                                    <div class="layui-input-prefix">
                                        <i class="layui-icon layui-icon-vercode"></i>
                                    </div>
                                    <input type="text" name="captcha" placeholder="请输入验证码" class="layui-input" lay-verify="required">
                                </div>
                            </div>
                            <div class="layui-col-xs4">
                                <div style="margin-left: 10px;">
                                    <img id = "captchaImg" src="/auth/setCaptcha" alt="" style="margin:3px 0 3px 0;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 找回密码 -->
                    <div class="layui-form-item" style = "text-align: right;">
                        <a href="/index/forget">忘记密码？点击找回</a>                        
                    </div>

                    <div class="layui-form-item">
                        <input type="submit" value="登录" class="layui-btn layui-btn layui-btn-fluid" lay-submit>
                    </div>

                    <div class="layui-form-item">
                        <a href="/index/register">没有账号？点击注册</a>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
    <script>
        // 图形验证码刷新
        document.getElementById('captchaImg').addEventListener('click', function() {
            var captchaImg = document.getElementById('captchaImg');
            captchaImg.src = '/auth/setCaptcha';
        });

        layui.use(function() {
            var form = layui.form;
            var layer = layui.layer;

            // 自定义验证规则
            form.verify({
                // 验证用户名，且为必填项
                username: function(value, elem) {
                    // 允许字母、数字、下划线、中文、空格、·、点（.）和@符号
                    if (!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·@.]+$").test(value)) {
                        return '用户名不能有特殊字符';
                    }
                    if (/(^_)|(__)|(_+$)/.test(value)) {
                        return '用户名首尾不能出现下划线';
                    }
                    // 如果用户输入的是邮箱地址，进一步验证邮箱格式
                    if (value.includes('@')) {
                        if (!new RegExp("^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\\.[a-zA-Z0-9-.]+$").test(value)) {
                            return '邮箱格式不正确';
                        }
                    }
                },
                // 验证密码，且为必填项
                password: function(value, elem) {
                    if (!/^[\S]{6,16}$/.test(value)) {
                        return '密码必须为 6 到 16 位的非空字符';
                    }
                }
            });

            // 监听表单提交事件
            form.on('submit', function(data) {
                // 阻止表单默认提交
                event.preventDefault();

                // 使用 fetch 提交表单数据
                fetch('/index/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded', // 使用表单数据格式
                    },
                    body: new URLSearchParams(data.field), // 将表单数据转换为 URL 编码格式
                })

                .then(response => response.json()) // 解析 JSON 响应
                .then(result => {
                    if (result.code === 0) {
                        // 显示成功提示
                        layer.msg(result.msg, {
                            icon: 1,
                            time: 1500 // 提示框显示 1.5 秒
                        }, function() {
                            // 在提示框消失后关闭弹窗
                            window.parent.layer.closeAll(); // 关闭所有弹窗
                        });
                    } else {
                        layer.msg(result.msg || '登录失败', { icon: 2 });
                    }
                })

                .catch(error => {
                    console.error('提交失败:', error);
                    layer.msg('网络错误，请重试', { icon: 2 });
                });

                return false; // 阻止表单默认提交
            });
        });
    </script>
</body>
</html>
