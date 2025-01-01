<?php
    use Helper\View;
    View::view('/admin/updateHead');
?> 
    <tr id = "name">
        <td></td>
        <td><input type="text" name="name" class="layui-input" lay-verify="required">
        </td>
    </tr>
    <tr id = "colorCode">
        <td></td>
        <td><input type="text" name="colorCode" class="layui-input">
        </td>
    </tr>
    <tr id = "url">
        <td></td>
        <td><input type="text" name="url" class="layui-input" lay-verify="required">
        </td>
    </tr>
    <tr id = "blank">
        <td></td>
        <td><select name="blank">
                <option value=""></option>
                <option value="1">是</option>
                <option value="0">否</option>
            </select>
        </td>
    </tr>
    <tr id = "type">
        <td></td>
        <td>
            <select name="type" lay-verify="required">
                <option value=""></option>
                <option value="友情链接">友情链接</option>
                <option value="赞助商">赞助商</option>
                <option value="内部链接">内部链接</option>
            </select>
        </td>
    </tr>
    <tr id = "sort">
        <td></td>
        <td><input type="text" name="sort" class="layui-input"  lay-verify="number">
        </td>
    </tr>
    <script src="/js/admin/footUrl/update.js"></script>
<?php
    View::view('/admin/updateFoot');
?>