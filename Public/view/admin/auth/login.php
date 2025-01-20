<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EOGEE</title>
    <link rel="stylesheet" href="/layui/css/layui.css">
    <link rel="stylesheet" href="/css/auth.css">    
    <?= CONFIG['app']['dark_theme'] ?"<link rel='stylesheet' href='/css/eogee-admin-dark.css' rel='stylesheet'>" : null?>
    <script src="/layui/layui.js"></script>
</head>

<body style="background-color:#2f363c">
    <div class="layui-row layui-hide layui-show-md-block layui-show-sm-block" style="height: 130px"></div>
    <div class="layui-row">
        <div class="layui-col-xs12 layui-col-sm4 layui-col-md4" style="height: 130px"></div>
        <div class="layui-col-xs12 layui-col-sm4 layui-col-md4">
            <h1>EOGEE</h1>
            <form class="layui-form"  method="post">
                <div class="demo-login-container">
                    <div class="layui-form-item">
                        <div class="layui-input-wrap">
                            <div class="layui-input-prefix">
                                <i class="layui-icon layui-icon-username"></i>
                            </div>
                            <input type="text" name="username" placeholder="请输入用户名" class="layui-input" lay-verify="required|username">
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
                    <div class="layui-form-item <?=CONFIG['app']['developer_mode'] == true ? 'layui-hide' : null ?>">
                        <div class="layui-row">
                            <div class="layui-col-xs8">
                                <div class="layui-input-wrap">
                                    <div class="layui-input-prefix">
                                        <i class="layui-icon layui-icon-vercode"></i>
                                    </div>
                                    <input type="text" name="captcha" placeholder="请输入验证码" class="layui-input" lay-verify="<?=CONFIG['app']['developer_mode'] == false ? 'required' : null ?>">
                                </div>
                            </div>
                            <div class="layui-col-xs4">
                                <div style="margin-left: 10px;">
                                    <img id ="captchaImg" src="/auth/setCaptcha" alt="" style="margin:3px 0 3px 0;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <input type="submit" value="登录" class="layui-btn layui-btn-normal layui-btn-fluid" lay-submit>
                    </div>
                </div>
            </form>
        </div>
    <script>
        // 图形验证码刷新
        document.getElementById('captchaImg').addEventListener('click', function() {
            var captchaImg = document.getElementById('captchaImg');
            captchaImg.src = '/auth/setCaptcha';
        });

        layui.use(function() {
            var form = layui.form;
            // 自定义验证规则
            form.verify({
                // 验证用户名，且为必填项
                username: function(value, elem) {
                    if (!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)) {
                        return '用户名不能有特殊字符';
                    }
                    if (/(^_)|(__)|(_+$)/.test(value)) {
                        return '用户名首尾不能出现下划线';
                    }
                },
                // 验证密码，且为必填项
                password: function(value, elem) {
                    if (!/^[\S]{6,16}$/.test(value)) {
                        return '密码必须为 6 到 16 位的非空字符';
                    }
                }
            });
        });
    </script>
</body>

</html>