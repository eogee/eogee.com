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
    <tr id = "sort">
        <td></td>
        <td>
            <input type = "text" name="sort" class="layui-input" lay-verify="number">
        </td>
    </tr>
    <tr id = "permission">
        <td></td>
        <td id = "permissionCheck"></td>
    </tr>
    <script src = "/js/admin/role/update.js"></script>
    <script>
        layui.use(function(){
            var tree = layui.tree;            
            // 模拟数据

            var data = tableData.data.permission;
            var data = JSON.parse(data);
            /* [
                {title:'早餐',id:1,spread:true,children:[
                        {title:'拌粉',id:5}
                        ,{title:'蒸饺',id:6}
                        ,{title:'豆浆',id:7}
                ]}
                ,{title:'午餐',id:2,spread:true,checked:true,children:[
                    {title:'藜蒿炒腊肉',id:8}
                    ,{title:'西湖醋鱼',id:9}
                    ,{title:'小白菜',id:10}
                    ,{title:'海带排骨汤',id:11}
                ]}
                ,{title:'晚餐',id:3,spread:true,children:
                    [{title:'红烧肉',id:12}
                    ,{title:'番茄炒蛋',id:13}
                ]}
                ,{title:'夜宵',id:4,spread:true,children:[
                    {title:'小龙虾',id:14,checked:true}
                    ,{title:'香辣蟹',id:15,checked:true}
                    ,{title:'烤鱿鱼',id:16}]
                }];*/
            tree.render({
                elem: '#permissionCheck'
                ,data: data
                ,showCheckbox: true
                ,id: 'permissionCheck'
            }); 
            var checkData = tree.getChecked('permissionCheck');
            checkData = JSON.stringify(checkData);
            console.log(checkData);
        });
    </script>
<?php
    View::view('/admin/updateFoot');
?>