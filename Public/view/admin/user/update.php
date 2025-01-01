<?php
    use Helper\View;
    View::view('/admin/updateHead');
?>
    <tr id = "username">
        <td></td>
        <td>
            <input id = "usernameInput" type = "text" name="username" class="layui-input" lay-verify="required|username">
        </td>
    </tr>
    <tr id = "identity">
        <td></td>
        <td>
            <select name="identity">
                <option value=""></option>
                <option value="管理员">管理员</option>
                <option value="普通用户">普通用户</option>
            </select>
        </td>
    </tr>
    <tr id = "adminRoleId">
        <td></td>
        <td>
            <select id = "adminRoleIdSelect" name="adminRoleId">
                <option value=""></option>
            </select>
        </td>
    </tr>
    <tr id = "password">
        <td></td>
        <td>
            <input id = "passwordInput" type = "password" name="password" class="layui-input"  lay-affix="eye" lay-verify="required|password">
        </td>
    </tr>
    <tr id = "passwordRepeat">
        <td>*确认密码</td>
        <td>
            <input id = "passwordRepeatInput" type = "password" name="passwordRepeat" class="layui-input" lay-affix="eye" lay-verify="required|passwordRepeat">
        </td>
    </tr>
    <script src = "/js/admin/user/update.js"></script>
<?php
    View::view('/admin/updateFoot');
?>