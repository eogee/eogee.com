ajax('/'+modelName+'/updateApi/'+tableId,false,function(response){
    tableData = JSON.parse(response);
});

pushField();

// 填充角色下拉框
populateSelectOptions('adminRoleIdSelect', tableData.options);

if(pageName == 'edit'){
    pushData(['passwordRepeat']);
    document.getElementById('passwordRepeat').children[1].children[0].value = tableData.data.password;
}
// 用户名重复验证
document.getElementById('usernameInput').addEventListener('blur', function() {
    var username = document.getElementById('usernameInput').value;
    if (username == '') {
        return;
    }
    ajax('/'+modelName+'/checkUsernameApi/'+username, false, function(response) {
        response = JSON.parse(response);
        if (response.code > 0) {
            layer.msg(response.msg,{icon: 2, time: 1000});
        }else{
            layer.msg(response.msg,{icon: 1, time: 1000});
        }
    });
});

// 表单验证
layui.use(function() {
    var form = layui.form;
    form.verify({
        // 验证用户名
        username: function(value, elem) {
            if (!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)) {
                return '用户名不能有特殊字符';
            }
            if (/(^_)|(__)|(_+$)/.test(value)) {
                return '用户名首尾不能出现下划线';
            }
        }
    });
    // 监听密码输入是否变化
    var inputElement = document.getElementById('passwordInput');
    inputElement.addEventListener('input', function(event) {
        form.verify({
            // 验证密码
            password: function(value, elem) {
                if (!/^[\S]{6,16}$/.test(value)) {
                    return '新密码必须为 6 到 16 位的非空字符';
                }
            }
        });
    });
    // 监听确认密码输入是否变化
    form.verify({
        // 验证确认密码
        passwordRepeat: function(value, elem) {
            if (value!= document.getElementById('passwordInput').value) {
                return '两次输入的密码不一致';
            }
        }
    });
});