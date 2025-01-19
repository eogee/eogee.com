<?php
    use Easy\View\View;
    View::view('/admin/updateHead');
?>
    <tr id = "title">
        <td></td>
        <td>
            <input type = "text" name = "title" class="layui-input" lay-verify="required">
        </td>
    </tr>
    <tr id = "keywords">
        <td></td>
        <td>
            <input type = "text" name = "keywords" class="layui-input" lay-verify="required">
        </td>
    </tr>
    <tr id = "description">
        <td></td>
        <td>
            <input type = "text" name = "description" class="layui-input" lay-verify="required">
        </td>
    </tr>
    <tr id = "content">
        <td></td>
        <td>
            <textarea name = "content" id = "content" class="layui-textarea" lay-verify="required"></textarea>
        </td>
    </tr>
    <tr id = "authorId">
        <td></td>
        <td>
            <input type = "text" name = "authorId" class="layui-input" lay-verify="required">
        </td>        
    </tr>
    <tr id = "authorUsername">
        <td></td>
        <td>
            <input type = "text" name = "authorUsername" class="layui-input" lay-verify="required">
        </td>
        
    </tr>
    <tr id = "authorNickname">
        <td></td>
        <td>
            <input type = "text" name = "authorNickname" class="layui-input" lay-verify="required">
        </td>        
    </tr>
    <tr id = "categoryId">
        <td></td>
        <td>
            <input type = "text" name = "categoryId" class="layui-input" lay-verify="required">
        </td>        
    </tr>
    <tr id = "categoryName">
        <td></td>
        <td>
            <input type = "text" name = "categoryName" class="layui-input" lay-verify="required">
        </td>        
    </tr>
    <tr id = "sort">
        <td></td>
        <td>
            <input type = "text" name = "sort" class="layui-input"  lay-verify="number">
        </td>        
    </tr>
    <script src = "/js/admin/article/update.js"></script>
<?php
    View::view('/admin/updateFoot');
?>