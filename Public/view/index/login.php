<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EOGEE</title>
    <link rel="stylesheet" href="/layui/css/layui.css">
    <script src="/layui/layui.js"></script>
    <style>
        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .demo-login-container {
            width: 350px;
            margin: 21px auto 0;
        }

        .demo-login-other .layui-icon {
            position: relative;
            display: inline-block;
            margin: 0 2px;
            top: 2px;
            font-size: 26px;
        }
        h1{
            text-align: center;
            color: #2f363c;
            font-size: 40px;
        }
    </style>
</head>

<body>
    <div class="layui-row layui-hide layui-show-md-block layui-show-sm-block" style="height: 130px"></div>
    <div class="layui-row">
        <div class="layui-col-xs12 layui-col-sm4 layui-col-md4" style="height: 50px"></div>
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
                                    <img src="/auth/setCaptcha" alt="" style="margin:3px 0 3px 0;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 找回密码 -->
                    <div class="layui-form-item" style = "text-align: right;">
                        <a href="/auth/forget">忘记密码？</a>                        
                    </div>

                    <div class="layui-form-item">
                        <input type="submit" value="登录" class="layui-btn layui-btn layui-btn-fluid" lay-submit>
                    </div>

                    <div class="layui-form-item">
                        <a href="/auth/register">没有账号？点击注册</a>
                    </div>
                    
                </div>
            </form>
        </div>
    <script>
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