<?php
    use Easy\View\View;
    View::view('/admin/updateHead');
?>
    <tr id = "name">
        <td></td>
        <td>
            <input type = "text" name="name" class="layui-input" lay-verify="required">
        </td>
    </tr>
    <tr id = "keywords">
        <td></td>
        <td>
            <input type = "text" name="keywords" class="layui-input" lay-verify="required">
        </td>
    </tr>
    <tr id = "description">
        <td></td>
        <td>
            <input type = "text" name="description" class="layui-input" lay-verify="required">
        </td>
    </tr>
    <tr id = "sort">
        <td></td>
        <td>
            <input type = "text" name="sort" class="layui-input" lay-verify="number">
        </td>
    </tr>
    <script src = "/js/admin/category/update.js"></script>
<?php
    View::view('/admin/updateFoot');
?>