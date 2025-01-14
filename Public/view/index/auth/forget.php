<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EOGEE</title>
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
                                <i class="layui-icon layui-icon-email"></i>
                            </div>
                            <input id = "emailInput" type="text" name="email" placeholder="请输入邮箱" class="layui-input" lay-verify="required|email">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-row">
                            <div class="layui-col-xs8">
                                <div class="layui-input-wrap">
                                    <div class="layui-input-prefix">
                                        <i class="layui-icon layui-icon-vercode"></i>
                                    </div>
                                    <input id = "captchaInput" type="text" name="captcha" placeholder="请输入验证码" class="layui-input" lay-verify="required|captcha">
                                </div>
                            </div>
                            <div class="layui-col-xs4">
                                <div style="margin-left: 10px;">
                                    <img id = "captchaImg" src="/auth/setCaptcha" alt="" style="margin:3px 0 3px 0;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-row">
                            <div class="layui-col-xs8">
                                <div class="layui-input-wrap">
                                    <div class="layui-input-prefix">
                                        <i class="layui-icon layui-icon-vercode"></i>
                                    </div>
                                    <input id = "emailCaptchaInput" type="text" name="emailCaptcha" placeholder="请输入邮箱验证码" class="layui-input" lay-verify="required|emailCaptcha">
                                </div>
                            </div>
                            <div class="layui-col-xs4">
                                <div style="margin-left: 10px;">
                                    <button type="button" class="layui-btn layui-btn-primary" id="sendEmailCaptcha">发送验证码</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-wrap">
                            <div class="layui-input-prefix">
                                <i class="layui-icon layui-icon-password"></i>
                            </div>
                            <input id = "password" type="password" name="password" placeholder="请输入新密码" class="layui-input" lay-affix="eye" lay-verify="required|password">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-wrap">
                            <div class="layui-input-prefix">
                                <i class="layui-icon layui-icon-password"></i>
                            </div>
                            <input id = "passwordRepeat" type="password" name="passwordRepeat" placeholder="请再次输入新密码" class="layui-input" lay-affix="eye" lay-verify="required|password">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <input type="submit" value="重置密码" class="layui-btn layui-btn layui-btn-fluid" lay-submit>
                    </div>

                    <div class="layui-form-item">
                        <a href="/index/register">点此注册新账号</a>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
    <script>

        layui.use(function() {
            var form = layui.form;
            var layer = layui.layer;

            // 自定义验证规则
            form.verify({
                // 验证密码，且为必填项
                password: function(value, elem) {
                    if (!/^[\S]{6,16}$/.test(value)) {
                        return '密码必须为 6 到 16 位的非空字符';
                    }
                },
                // 验证图形验证码为4位
                captcha: function(value, elem) {
                    if (!/^[\S]{4}$/.test(value)) {
                        return '验证码为4位的非空字符';
                    }
                },
                // 验证邮箱验证码为6位
                emailCaptcha: function(value, elem) {
                    if (!/^\d{6}$/.test(value)) {
                        return '邮箱验证码为6位数字';
                    }
                }
            });
            // 图形验证码刷新
            document.getElementById('captchaImg').addEventListener('click', function() {
                var captchaImg = document.getElementById('captchaImg');
                captchaImg.src = '/auth/setCaptcha';
            });

            // 密码一致验证
            document.getElementById('passwordRepeat').addEventListener('blur', function() {
                var passwordRepeat = document.getElementById('passwordRepeat').value;
                var password = document.getElementById('password').value;
                if (password !== passwordRepeat) {
                    layer.msg('两次输入的密码不一致', { icon: 2, time: 1000 });
                }
            });

            // 发送邮箱验证码
            document.getElementById('sendEmailCaptcha').addEventListener('click', function() {
                // 调用 check 方法
                check()
                .then(result => {
                    if (result) {
                        // 禁用按钮，并开始倒计时
                        var sendButton = this;
                        sendButton.disabled = true; // 禁用按钮                
                        var count = 60;
                        sendButton.innerText = count + '秒再试';

                        var timer = setInterval(function() {
                            count--;
                            sendButton.innerText = count + '秒再试';

                            if (count <= 0) {
                                clearInterval(timer); // 清除定时器
                                sendButton.innerText = '发送验证码'; // 恢复按钮文本
                                sendButton.disabled = false; // 启用按钮
                            }
                        }, 1000); // 每秒执行一次                        

                        // 发送邮箱验证码
                        // todo:该邮箱是否存在
                        const email = document.getElementById('emailInput').value;
                        ajaxPost('/user/sendEmailCaptchaApi', "email="+email, false, function(response) {
                            response = JSON.parse(response);
                            if (response.code > 0) {
                                layer.msg(response.msg,{icon: 2, time: 1000});
                            }else{
                                layer.msg(response.msg,{icon: 1, time: 1000});
                            }
                        });
                    }
                })
                .catch(error => {
                    console.log('验证失败');
                    // 处理验证失败的情况
                });
            });

            // 监听表单提交事件
            form.on('submit', function(data) {
                // 阻止表单默认提交
                event.preventDefault();
                
                // 调用 passwordCheck 方法
                passwordCheck()
                .then(result => {
                    if (result) {

                        // 使用 fetch 提交表单数据
                        fetch('/index/forget', {
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
                                    // 重置成功后跳转到登录页面
                                    window.location.href = result.url;
                                });
                            } else {
                                layer.msg(result.msg || '重置失败', { icon: 2 });
                            }
                        })

                        .catch(error => {
                            console.error('提交失败:', error);
                            layer.msg('网络错误，请重试', { icon: 2 });
                        });

                        return false; // 阻止表单默认提交
                    }
                })
                .catch(error => {
                    console.log('验证失败');
                    // 处理验证失败的情况
                });
            }); 

            // 验证用户名、邮箱、验证码有效性
            async function check() {
                try {
                    // 验证邮箱有效性
                    const email = document.getElementById('emailInput').value;
                    if (!email) {
                        throw new Error('请先输入邮箱地址');
                    } else if (!/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(email)) {
                        throw new Error('邮箱格式不正确');
                    }

                    // todo:验证邮箱是否存在
                    const emailResponse = await fetch('/user/checkEmailApi', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `email=${email}`
                    });
                    const emailData = await emailResponse.json();
                    if (emailData.code > 0) {
                        throw new Error(emailData.msg);
                    }

                    // 验证验证码
                    const captcha = document.getElementById('captchaInput').value;
                    if (!captcha) {
                        throw new Error('请先输入图形验证码');
                    }

                    const captchaResponse = await fetch('/user/checkCaptchaApi', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `captcha=${captcha}`
                    });
                    const captchaData = await captchaResponse.json();
                    if (captchaData.code > 0) {
                        throw new Error(captchaData.msg);
                    }

                    return true; // 验证成功
                } catch (error) {
                    layer.msg(error.message, { icon: 2, time: 1000 });
                    return false; // 验证失败
                }
            }

            async function passwordCheck() {
                try {
                    // 验证验证码
                    const emailCaptcha = document.getElementById('emailCaptchaInput').value;
                    const emailCaptchaResponse = await fetch('/user/checkEmailCaptchaApi', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `emailCaptcha=${emailCaptcha}`
                    });
                    const emailCaptchaData = await emailCaptchaResponse.json();
                    if (emailCaptchaData.code > 0) {
                        throw new Error(emailCaptchaData.msg);
                    }

                    // 验证密码
                    const password = document.getElementById('password').value;
                    const passwordRepeat = document.getElementById('passwordRepeat').value;
                    if (password !== passwordRepeat) {
                        throw new Error('两次输入的密码不一致');
                    }

                    return true; // 验证成功
                } catch (error) {
                    layer.msg(error.message, { icon: 2, time: 1000 });
                    return false; // 验证失败
                }
            }
        });
    </script>
</body>
</html>
