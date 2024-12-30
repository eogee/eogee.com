<?php
    require_once 'Resource/View/admin/updateHead.php';
?>

    <tr id = "parentId">
        <td></td>
        <td>
            <input type="text" name="parentId" class="layui-input" lay-verify="required" readonly>
        </td>
    </tr>
    <tr id = "name">
        <td></td>
        <td><input type="text" name="name" class="layui-input"  lay-verify="required">
        </td>
    </tr>
    <tr id = "url">
        <td></td>
        <td><input type="text" name="url" class="layui-input"  lay-verify="required">
        </td>
    </tr>
    <tr id = "sort">
        <td></td>
        <td><input type="text" name="sort" class="layui-input"  lay-verify="number">
        </td>
    </tr>
    <script src = "/Resource/js/admin/permission/update.js"></script>
<?php
    require_once 'Resource/View/admin/updateFoot.php';
?>