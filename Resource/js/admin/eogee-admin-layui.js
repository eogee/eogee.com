/**
 * eogee-admin-layui.js
 * @author: eogee.com
 * @version: 1.0.0
 * @bugContacts: You can contact us by email:eogee@qq.com or QQ: 3886370035
 * @联系我们: 邮箱:eogee@qq.com 或 QQ: 3886370035
 */

/**
 * 全局变量 * 
 */
var uri = window.location.pathname;// 当前页面地址
uri = uri.split('/');
var modelName = uri[1];// 模型名称
var pageName = uri[2];// 当前页面名称
var tableId = uri[3];// 当前页面id
/**
 * 导航栏-选中效果
 */
function nav(){
    switch(modelName){
        case 'basicInfo':
            document.getElementById('indexNav').classList.add('layui-nav-itemed');
            document.getElementById('basicInfoChildNav').classList.add('layui-this');
            break;
        case 'carousel':
            document.getElementById('indexNav').classList.add('layui-nav-itemed');
            document.getElementById('carouselChildNav').classList.add('layui-this');
            break;
        case 'footUrl':
            document.getElementById('indexNav').classList.add('layui-nav-itemed');
            document.getElementById('footUrlChildNav').classList.add('layui-this');
            break;
        case 'contentParent':
            document.getElementById('contentParentNav').classList.add('layui-nav-itemed');
            document.getElementById('contentParentChildNav').classList.add('layui-this');
            break;
        case'singlePage':
            document.getElementById('contentParentNav').classList.add('layui-nav-itemed');
            document.getElementById('singlePageChildNav').classList.add('layui-this');
            break;
        case 'news':
            document.getElementById('contentParentNav').classList.add('layui-nav-itemed');
            document.getElementById('newsChildNav').classList.add('layui-this');
            break;
    }
}
/**
 * 导航栏-移动端自适应
 */
function mobileNav(){
    if (window.innerWidth < 850){
        document.getElementById('iconLeft').classList.remove('layui-hide');
        document.getElementById('textLayer').classList.add('layui-hide');
        document.getElementById('textLogout').classList.add('layui-hide');
        document.getElementById('iconLayer').classList.remove('layui-hide');
        document.getElementById('iconLogout').classList.remove('layui-hide');

        document.getElementById('iconLeft').onclick = function(){
            document.querySelector('.layui-side').classList.remove('layui-hide-xs');
            document.getElementById('iconLeft').classList.add('layui-hide');
            document.getElementById('iconRihgt').classList.remove('layui-hide');
        };
        document.getElementById('iconRihgt').onclick = function(){
            document.querySelector('.layui-side').classList.add('layui-hide-xs');
            document.getElementById('iconLeft').classList.remove('layui-hide');
            document.getElementById('iconRihgt').classList.add('layui-hide');
        }
    }
}
/**
 * get ajax请求
 */
function ajax(url,async,callback){
    var request = new XMLHttpRequest();
    request.open('GET', url, async);  
    request.onload = function() {
        if (request.status == 200) {
            callback(request.responseText);
        }else if (request.status != 200) {
            layer.msg('操作执行失败',{icon: 2, time: 1000});
        }
    };
    request.send();
}
/**
 * post ajax请求
 */
function ajaxPost(url,data,async,callback){
    var request = new XMLHttpRequest();
    request.open('POST', url, async);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.onload = function() {
        if (request.status == 200) {
            callback(request.responseText);
        }else if (request.status != 200) {
            layer.msg('操作执行失败',{icon: 2, time: 1000});
        }
    };
    request.send(data);
}
/**
 * 表格头部设置
 * 可自定义显示 list 和  recycle
 * 控制显示 操作按钮组的列宽
 */
function tableHeadSet(){
    if(pageName == 'list'){
        var list = document.getElementById("list");
        list.classList.add("layui-this");
        var recycle = document.getElementById("recycle");
        recycle.onclick = ()=>{
            window.location.href = "/"+modelName+"/recycle";
        }
    }else if(pageName =='recycle'){
        var list = document.getElementById("list");
        list.onclick = ()=>{
            window.location.href = "/"+modelName+"/list";
        }
        var recycle = document.getElementById("recycle");
        recycle.classList.add("layui-this");
    }
    if(pageName == 'list'){
        handleColwidth = 166;
    }else if(pageName =='recycle'){
        handleColwidth = 120;
    }
}
/**
 * 获取表格名称和字段名称
 * 名称来自于数据表注释
 */
function tableHeadData(){
    ajax('/'+modelName+'/tableHeadDataApi',false, function(response) {
        response = JSON.parse(response);
        document.getElementById("tableComment").innerHTML = response.tableComment;// 表格注释
        tableFiledComment = response.tableFiledComment;// 表格字段注释
        if(!tableFiledComment.deleted_at){
            document.getElementById("recycle").innerHTML = null;
        }
    });
}
/**
 * 表格行高-移动端自适应
 */
if (window.innerWidth < 850){
    var lineHeight = '';
}else{
    var lineHeight = '90';
}
/**
 * 表格分页-移动端自适应
 */
if (window.innerWidth < 850){            
    var page = {
        layout: ['prev', 'page', 'next','count','limit'], //自定义分页布局
        groups: 2, //只显示 2 个连续页码
        first: false, //不显示首页
        last: false //不显示尾页
    };
}else{
    var page = true;
}
/**
 * 表格列-移动端、PC端自适应
 */
function generateColumns(tableFiledComment, hides, sorts, handleColwidth) {
    let cols = [];

    if (window.innerWidth > 850) {
        cols.push({ checkbox: true });
        let count = Object.keys(tableFiledComment).length;

        for (let i = 0; i < count; i++) {
            let key = Object.keys(tableFiledComment)[i];
            let obj = { field: key, title: tableFiledComment[key] };

            if (key === 'id') {
                obj.sort = true;
                obj.maxWidth = 98;
            } else if (typeof hides !== "undefined" && hides.indexOf(key) > -1) {
                obj.hide = true;
            } else if (typeof sorts !== "undefined" && sorts.indexOf(key) > -1) {
                obj.sort = true;
            }

            cols.push(obj);
        }

        let objLast = { fixed: '', title: '操作', width: handleColwidth, toolbar: '#rowToolbar' };
        cols.push(objLast);
    } else {
        cols.push({ checkbox: true });
        cols.push({
            field: 'content',
            title: '内容',
            templet: function (d) {
                let values = '';
                layui.each(d, function (index, item) {
                    if (index !== 'LAY_COL' && index !== 'LAY_NUM' && index !== 'LAY_INDEX' && index !== 'LAY_INDEX_INIT' && hides.indexOf(index) === -1) {
                        for (let i = 0; i < Object.keys(tableFiledComment).length; i++) {
                            let key = Object.keys(tableFiledComment)[i];
                            if (key === index) {
                                index = tableFiledComment[key];
                            }
                        }
                        values += '<p><strong>' + index + ':</strong>' + item + '</p>';
                    }
                });
                return '<div>' + values + '</div>';
            }
        });
        cols.push({ fixed: '', title: '操作', width: 70, toolbar: '#rowToolbarMobile' });
    }
    return cols;
}
/**
 * 弹出页面大小-移动端自适应
 */
if (window.innerWidth < 850){
    var area = ['100%', '100%'];
}else{
    var area = ['85%', '85%'];
}
/**
 * 表格工具栏-移动端自适应(默认隐藏)
 */
if (window.innerWidth < 850){
    var defaultToolbar = [];
}else{
    var defaultToolbar = [
        'filter'
        ,'exports'
        ,'print'
    ];
}
/**
 * 表头、行按钮组-移动端自适应
 */
function renderRtn(hasRecycle){
    if(hasRecycle){
        if(pageName == 'list'){
            var toolbar = document.getElementById("toolbar");
            toolbar.innerHTML = `
                <button id="insert" class="layui-btn layui-btn-primary layui-btn-sm" lay-event="insert">新增</button>
                <button id="deleteSoftBatch" class="layui-btn layui-btn-danger layui-btn-sm" lay-event="deleteSoftBatch">批量删除</button>`;
            var rowToolbar = document.getElementById("rowToolbar");
            rowToolbar.innerHTML = `
                <button type="button" class="layui-btn layui-btn-xs layui-btn-primary" lay-event="show">详情</button>
                <button type="button" class="layui-btn layui-btn-xs layui-btn-primary" lay-event="edit">编辑</button>
                <button type="button" class="layui-btn layui-btn-xs layui-btn-danger" lay-event="deleteSoft">删除</button>
            `;
            var rowToolbarMobile = document.getElementById("rowToolbarMobile");
            rowToolbarMobile.innerHTML = `
                <button type="button" class="layui-btn layui-btn-xs layui-btn-primary" lay-event="show">详情</button><br/>
                <button type="button" class="layui-btn layui-btn-xs layui-btn-primary" lay-event="edit">编辑</button><br/>
                <button type="button" class="layui-btn layui-btn-xs layui-btn-danger" lay-event="deleteSoft">删除</button>
            `;
        }else if(pageName =='recycle'){
            var toolbar = document.getElementById("toolbar");
            toolbar.innerHTML = `
                <button id="restoreBatch" class="layui-btn layui-btn-primary layui-btn-sm" lay-event="restoreBatch">恢复</button>
                <button id="deleteBatch" class="layui-btn layui-btn-danger layui-btn-sm" lay-event="deleteBatch">彻底删除</button>`;
            var rowToolbar = document.getElementById("rowToolbar");
            rowToolbar.innerHTML = `
                <button type="button" class="layui-btn layui-btn-xs layui-btn-primary" lay-event="restore">恢复</button>
                <button type="button" class="layui-btn layui-btn-xs layui-btn-danger" lay-event="delete">删除</button>
            `;
            var rowToolbarMobile = document.getElementById("rowToolbarMobile");
            rowToolbarMobile.innerHTML = `
                <button type="button" class="layui-btn layui-btn-xs layui-btn-primary" lay-event="restore">恢复</button><br/>
                <button type="button" class="layui-btn layui-btn-xs layui-btn-danger" lay-event="delete">删除</button>
            `;
        }
    }else{
        var toolbar = document.getElementById("toolbar");
        toolbar.innerHTML = `
            <button id="insert" class="layui-btn layui-btn-primary layui-btn-sm" lay-event="insert">新增</button>
            <button id="deleteSoftBatch" class="layui-btn layui-btn-danger layui-btn-sm" lay-event="deleteSoftBatch">批量删除</button>`;
        var rowToolbar = document.getElementById("rowToolbar");
        rowToolbar.innerHTML = `
            <button type="button" class="layui-btn layui-btn-xs layui-btn-primary" lay-event="show">详情</button>
            <button type="button" class="layui-btn layui-btn-xs layui-btn-primary" lay-event="edit">编辑</button>
            <button type="button" class="layui-btn layui-btn-xs layui-btn-danger" lay-event="delete">删除</button>`;
        var rowToolbarMobile = document.getElementById("rowToolbarMobile");
        rowToolbarMobile.innerHTML = `
            <button type="button" class="layui-btn layui-btn-xs layui-btn-primary" lay-event="show">详情</button><br/>
            <button type="button" class="layui-btn layui-btn-xs layui-btn-primary" lay-event="edit">编辑</button><br/>
            <button type="button" class="layui-btn layui-btn-xs layui-btn-danger" lay-event="delete">删除</button>
        `;
    }
}
/**
 *数据表格（回收站）渲染
 */
function renderTable(parentId){
    layui.use(function() {
        var table = layui.table;
        if(parentId == null){//判定是否需要根据子级id查询
            table.render({
                elem: '#table'
                ,url: '/' + modelName + '/' + pageName + 'Api'
                ,page: page
                ,toolbar: '#toolbar'
                ,type: 'checkbox'
                ,cols: [ cols ]
                ,id: 'table'
                ,lineStyle: 'height: ' + lineHeight
                ,defaultToolbar: defaultToolbar
            });
        }else{
            table.render({
                elem: '#table'
                ,url: '/' + modelName + '/' + pageName + 'Api/'+parentId
                ,page: page
                ,toolbar: '#toolbar'
                ,type: 'checkbox'
                ,cols: [ cols ]
                ,id: 'table'
                ,lineStyle: 'height: ' + lineHeight
                ,defaultToolbar: defaultToolbar
                ,where: { parentId: parentId }
            });
        }
    });
}
/**
 * 数据表格 搜索
 * 内容渲染
 * 提醒搜索选项
 * 功能实现
 */
function searchRow(){
    var search = document.getElementById("search");
    search.innerHTML = `
        <div class="layui-col-md4">
            <div class="layui-input-wrap">
                <input id = "searchOption" type="text" name="search" value=""class="layui-input" lay-affix="clear">
            </div>
        </div>
        <div class="layui-col-md4">
            <div class="layui-btn-container layui-col-xs12">
                <button class="layui-btn" lay-submit lay-filter="search">搜索</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
        `;
    ajax('/'+modelName+'/' + pageName + 'Api', false, function(response) {//搜索选项提醒
        response = JSON.parse(response);
        document.getElementById("searchOption").placeholder ="按"+response.searchOption+"查找";
    });
    layui.use(function(){
        var table = layui.table;
        var form = layui.form;
        form.on('submit(search)', function(data) {
            var field = data.field;// 获取搜索条件
            table.reload('table', {
                page: {curr: 1 }// 重载表格，从第一页开始
                ,where: field
            });
            return false;// 阻止表单默认跳转
        });
    });
}
/**
 * 数据表格 分页
 * 功能实现
 */
function renderPage(){
    layui.use(function(){
        var laypage = layui.laypage;
        var table = layui.table;
        laypage.render({
            jump: function(obj, first) {
                if (!first) {
                    ajax('/' + modelName + '/' + pageName + 'Api?page=' + obj.curr + '&limit=' + obj.limit, true, function() {
                        table.reload('table', {});
                    });
                }
            }
        });
    });
}
/**
 * 数据表格 新增行数据
 * 功能实现
 * 有参数表示新增子级数据
 */
function insertRow(parentId){
    layui.use(function(){
        var table = layui.table;
        var layer = layui.layer;
        if(parentId == null){
            table.on('toolbar', function(obj) {
                switch (obj.event) {
                    case 'insert':
                        layui.use('layer', function(index) {
                            var insert = layer.open({
                                title: '新增数据',
                                type: 2,
                                maxmin: true, //开启最大化最小化按钮
                                content: '/' + modelName + '/insert',
                                area: area,
                                btn: '提交',
                                btnAlign: 'l',
                                yes: function(index, layero) {
                                    var body = layui.layer.getChildFrame('body', index); //获取子窗体 body内容
                                    var inputArr = body.contents().find("#form")[0];
                                    var inputArrLength = inputArr.length;
                                    var value = inputArr[0].name + "=" + inputArr[0].value;
                                    for (var i = 1; i < inputArrLength; i++) {
                                        value += "&" + inputArr[i].name + "=" + inputArr[i].value;
                                    }
                                    var iframeWin = window[layero.find('iframe')[0]['name']];
                                    var vform = iframeWin.layui.form;
                                    vform.submit('form', function() {
                                        ajaxPost('/' + modelName + '/insert', value, true, function() {
                                            layer.close(insert);
                                            layer.msg('操作执行成功',{icon: 1, time: 1000});
                                            table.reload('table', {});
                                        });
                                    });
                                }
                            });
                        });
                    break;
                }
            });
        }else if(parentId !== null){
            table.on('toolbar', function(obj) {
                switch (obj.event) {
                    case 'insert':                                
                        layui.use('layer', function(index) {
                            var insert = layer.open({
                                title: '新增数据',
                                type: 2,
                                maxmin: true, //开启最大化最小化按钮
                                content: '/' + modelName + '/insert/' + parentId,
                                area: area,
                                btn: '提交',
                                btnAlign: 'l',
                                yes: function(index, layero) {
                                    var body = layui.layer.getChildFrame('body', index); //获取子窗体 body内容
                                    var inputArr = body.contents().find("#form")[0];
                                    var inputArrLength = inputArr.length;
                                    var value = inputArr[0].name + "=" + inputArr[0].value;
                                    for (var i = 1; i < inputArrLength; i++) {
                                        value += "&" + inputArr[i].name + "=" + inputArr[i].value;
                                    }
                                    var iframeWin = window[layero.find('iframe')[0]['name']];
                                    var vform = iframeWin.layui.form;
                                    vform.submit('form', function() {
                                        ajaxPost('/' + modelName + '/insert', value, true, function() {
                                            layer.close(insert);
                                            layer.msg('操作执行成功',{icon: 1, time: 1000});
                                            table.reload('table', {
                                                where: { parentId: parentId }
                                            });
                                        });
                                    });
                                }
                            });
                        });                                
                    break;
                }
            });
        }
    });
}
/**
 * 数据表格 批量操作: 软删除、恢复、删除
 * 功能实现
 */
function batch(){
    layui.use(function(){
        var table = layui.table;
        var layer = layui.layer;
        var deleteSoftBatch = document.getElementById('deleteSoftBatch');
        var restoreBatch = document.getElementById('restoreBatch');
        var deleteBatch = document.getElementById('deleteBatch');
        var id = [];
        var batchId = "";
        table.on('checkbox(table)', function(obj) {
            if(obj.type != 'one'){//判定是否为全选状态
                if(obj.checked){
                    var data = layui.table.cache['table'];//获取当前页全部数据
                    id = data.map(row => row['id']);
                } else {
                    id = [];
                }
            }else{
                if(obj.checked){//判定是否为选中状态
                    id.push(obj.data.id);
                }else{
                    index = id.indexOf(obj.data.id); //找到需去除元素的索引
                    if(index !== -1){
                        id.splice(index, 1); //去除数组中的元素，第二个参数表示去除数量
                    }
                }
            }
            if(id.length > 0){
                if(deleteSoftBatch){
                    deleteSoftBatch.onclick = function(){
                        layer.confirm("你确认要执行此操作吗？",{icon: 3, title:'警告'},()=>{
                            batchId = "batchId=" + id;
                            ajaxPost('/' + modelName + '/deleteSoftBatch', batchId, true, function() {
                                layer.msg('操作执行成功！',{icon: 1, time: 1000},()=>{
                                    window.location.reload();
                                });
                            });
                        });
                    }
                }
                if(restoreBatch){
                    restoreBatch.onclick = function(){
                        batchId = "batchId=" + id;
                        ajaxPost('/' + modelName + '/restoreBatch', batchId, true, function() {
                            layer.msg('操作执行成功！',{icon: 1, time: 1000},()=>{
                                window.location.reload();
                            });
                        });
                    }
                }
                if(deleteBatch){
                    deleteBatch.onclick = function(){
                        layer.confirm("你确认要执行此操作吗？",{icon: 3, title:'警告'},()=>{
                            batchId = "batchId=" + id;
                            ajaxPost('/' + modelName + '/deleteBatch', batchId, true, function() {
                                layer.msg('操作执行成功！',{icon: 1, time: 1000},()=>{
                                    window.location.reload();
                                });
                            }); 
                        });
                    }
                }
            }
        });
    });
}
/**
 * 数据表格 行工具栏: 详情、编辑、删除、软删除、恢复
 * 功能实现
 */
function rowToolbar(){
    layui.use(function() {
        var table = layui.table;
        var layer = layui.layer;
        table.on('tool(table)', function(obj) {
            var data = obj.data;
            var layEvent = obj.event;
            if (layEvent ==='show') {// 详情
                layer.open({
                    title: '查看数据详情',
                    type: 2,
                    maxmin: true,
                    content: '/' + modelName + '/show/' + data.id,
                    area: area
                });
            }
            if (layEvent ==='delete') {// 彻底删除行数据
                layer.confirm("你确认要执行此操作吗？",{icon: 3, title:'警告'},()=>{
                    obj.del();
                    ajax('/' + modelName + '/delete/' + data.id, true, function(){
                        table.reload('table', {});
                        layer.msg('操作执行成功',{icon: 1, time: 1000});
                    });
                });
            }
            if (layEvent ==='deleteSoft') {// 软删除行数据
                layer.confirm("你确认要执行此操作吗？",{icon: 3, title:'警告'},()=>{
                    obj.del();
                    ajax('/' + modelName + '/deleteSoft/' + data.id, true, function(){
                        table.reload('table', {});
                        layer.msg('操作执行成功',{icon: 1, time: 1000});
                    });
                });
            }
            if (layEvent === 'edit') {// 编辑行数据
                layui.use('layer', function(index) {
                    var layer = layui.layer;
                    var edit = layer.open({
                        title: '编辑数据',
                        type: 2,
                        maxmin: true,
                        content: '/' + modelName + '/edit/' + data.id,
                        area: area,
                        btn: '提交',
                        btnAlign: 'l',
                        yes: function(index, layero) {
                            var body = layui.layer.getChildFrame('body', index);
                            var inputArr = body.contents().find("#form")[0];
                            var inputArrLength = inputArr.length;
                            var value = inputArr[0].name + "=" + inputArr[0].value;
                            for (var i = 1; i < inputArrLength; i++) {
                                value += "&" + inputArr[i].name + "=" + inputArr[i].value;
                            }
                            var iframeWin = window[layero.find('iframe')[0]['name']];
                            var vform = iframeWin.layui.form;
                            vform.submit('form', function() {
                                ajaxPost('/' + modelName + '/edit', value, true, function() {
                                    layer.close(edit);
                                    table.reload('table', {});
                                    layer.msg('操作执行成功',{icon: 1, time: 1000});
                                });
                            });
                        }
                    });
                });
            }
            if (layEvent ==='restore') {// 恢复行数据
                obj.del();
                ajax('/' + modelName + '/restore/' + data.id, true, function(){
                    table.reload('table', {});
                    layer.msg('操作执行成功',{icon: 1, time: 1000});
                });
            }
        });
    });
}
/**
 * 单行表格渲染
 */
function oneLineTableRender(tableFiledComment, tableData) {
    // 将对象的值转换为数组
    tableFiledComment = Object.values(tableFiledComment);
    tableData = Object.values(tableData[0]);

    var tbody = document.getElementById('tbody');
    tbody.innerHTML = ''; // 清空之前的内容

    for (var i = 0; i < tableFiledComment.length; i++) {
        var tr = document.createElement("tr");
        var td1 = document.createElement("td");
        var td2 = document.createElement("td");

        td1.innerHTML = tableFiledComment[i];
        td2.innerHTML = tableData[i];

        tr.appendChild(td1);
        tr.appendChild(td2);
        tbody.appendChild(tr);
    }
}

/**
 * 单行表格编辑
 */
function editTable(){
    layui.use(function() {
        var layer = layui.layer;
        document.getElementById("eidtBtn").addEventListener("click", function() {
            var edit = layer.open({
                type: 2,
                maxmin: true,
                title: "编辑数据",
                content: "/"+modelName+"/edit/"+id,                
                area: area,
                btn: '提交',
                btnAlign: 'l',
                yes: function(index, layero) {
                    var body = layui.layer.getChildFrame('body', index); //获取子窗体 body内容
                    var inputArr = body.contents().find("#form")[0];
                    var inputArrLength = inputArr.length;
                    var value = inputArr[0].name + "=" + inputArr[0].value;
                    for (var i = 1; i < inputArrLength; i++) {
                        value += "&" + inputArr[i].name + "=" + inputArr[i].value;
                    }
                    var iframeWin = window[layero.find('iframe')[0]['name']];
                    var vform = iframeWin.layui.form;
                    vform.submit('form', function() {
                        ajaxPost('/' + modelName + '/edit', value, true, function() {                            
                            layer.msg('操作执行成功',{icon: 1, time: 1000},()=>{
                                layer.close(edit);
                                window.location.reload();
                            });
                        });
                    });
                }
            });
        });
    });
}
/**
 * 数据详情
 */
function renderShowTable(tableData) {
    var dataTbody = Object.values(tableData.data);
    var fieldTbody = Object.values(tableData.field);

    for(var i = 0; i < dataTbody.length; i++) {
        var tr = document.createElement("tr");
        var td1 = document.createElement("td");
        var td2 = document.createElement("td");
        td1.innerHTML = fieldTbody[i];
        td2.innerHTML = dataTbody[i];
        tr.appendChild(td1);
        tr.appendChild(td2);
        document.getElementById("tbody").appendChild(tr);
    }
}
/**
 * 渲染表单字段
 */
function pushField(){    
    document.getElementById('csrf_token').value = tableData.csrf_token;
    if(tableData.data !== null){
        document.getElementById('id').children[1].innerHTML = tableData.data.id;
    }    
    var count = Object.keys(tableData.field).length;
    for(var i = 0 ; i < count ; i++ ){
        var key = Object.keys(tableData.field)[i];
        var value = tableData.field[key];
        var nullable = tableData.nullable[key];
        if(key != 'deleted_at'  && key!= 'created_at' && key != 'updated_at' && key != 'enterId' && key != 'enter'){
            if(nullable == 'NO'){
                if(key == 'id'){                
                    document.getElementById(key).children[0].innerHTML = value;
                }else{
                    document.getElementById(key).children[0].innerHTML = '*'+value;
                }
            }else{
                document.getElementById(key).children[0].innerHTML = value;
            }
        }else if(key == 'enterId' || key == 'enter'){
            document.getElementById('enter').value = tableData.enter;
            document.getElementById('enterId').value = tableData.enterId;
        }
    }
}
/**
 * 渲染表单数据
 */
function pushData(keys){
    if(tableData.data !== null){
        document.getElementById('hiddenId').value = tableData.data.id;
        var count = Object.keys(tableData.field).length;
        for(var i = 0 ; i < count ; i++ ){
            var key = Object.keys(tableData.data)[i];
            var value = tableData.data[key];
            if(keys != null){
                if(key != 'id' && key!= 'deleted_at'  && key!= 'created_at' && key != 'updated_at' && key!= 'enter' && key!= 'enterId' && keys.indexOf(key) === -1){
                    document.getElementById(key).children[1].children[0].value = value;
                }
            }else{
                if(key != 'id' && key!= 'deleted_at'  && key!= 'created_at' && key != 'updated_at' && key!= 'enter' && key!= 'enterId'){
                    document.getElementById(key).children[1].children[0].value = value;
                }
            }
        }
    }    
}
/**
 * 上传文件
 */
function upload(id,url,size,exts){
    exts = exts || 'jpg|png|gif|jpeg';
    size = size || 1024;
    layui.use(function() {
        var upload = layui.upload;
        var layer = layui.layer;
        var element = layui.element;
        var $ = layui.$;
        var upload = upload.render({
            elem: '#'+id+'Btn'
            ,url: url // 上传接口
            ,data: { fileName: id } // 上传接口的额外参数
            ,size: size // 限制文件大小，单位 KB
            ,accept: 'file'
            ,exts: exts
            ,before: function(obj) {
                // 预读文件，不支持ie8
                obj.preview(function(index, file, result) {
                    $('#'+id+'Img').attr('src', result);
                });
                // 进度条复位
                element.progress(id+'Progress', '0%');
                layer.msg('上传中', {
                    icon: 16,
                    time: 0
                });
            }
            ,done: function(res) {
                if (res.code > 0) {
                    return layer.msg('上传失败');
                }
                $('#'+id+'Text').html(''); // 置空上传失败的状态
                if (res.code = 0) {
                    return layer.msg('上传成功');
                }
            }
            // 演示失败状态，并实现重传
            ,error: function() {                
                var demoText = $('#'+id+'Text');
                demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function() {
                    upload.upload();
                });
            }
            // 进度条
            ,progress: function(n, elem, e) {
                element.progress(id+'Progress', n + '%'); // 可配合 layui 进度条元素使用
                if (n == 100) {
                    layer.msg('上传完毕', {
                        icon: 1
                    });
                }
            }
        });
    });    
}
/**
 * 渲染下拉框选项
 */
function populateSelectOptions(selectId, options) {
    var selectElement = document.getElementById(selectId);
    options.forEach(function(item) {
        var option = document.createElement('option');
        option.value = item.id;
        option.text = item.name;
        selectElement.appendChild(option);
    });
}


