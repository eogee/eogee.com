modelName = 'log';        
pageName = 'list';

tableHeadSet();// 表头设置
tableHeadData();// 表格及字段数据

/* 表格字段定义 */
var hides = ['userId'];
var sorts = [];
var cols = generateColumns(tableFiledComment, hides, sorts, handleColwidth);

/* 表头按钮组定义 */
var toolbar = document.getElementById("toolbar");
toolbar.innerHTML = `
    <button id="download" class="layui-btn layui-btn-primary layui-btn-sm" lay-event="download">下载日志</button>
    <button id="clear" class="layui-btn layui-btn-danger layui-btn-sm" lay-event="clear">清空全部</button>
    `;
/* 桌面端行按钮组定义 */
var toolbar = document.getElementById("rowToolbar");
toolbar.innerHTML = `
    <button type="button" class="layui-btn layui-btn-xs layui-btn-primary" lay-event="show">详情</button>
    <button type="button" class="layui-btn layui-btn-xs layui-btn-danger" lay-event="delete">删除</button>            
`;
/* 移动端行按钮组定义 */
var toolbar = document.getElementById("rowToolbarMobile");
toolbar.innerHTML = `
    <button type="button" class="layui-btn layui-btn-xs layui-btn-primary" lay-event="show">详情</button><br/>
    <button type="button" class="layui-btn layui-btn-xs layui-btn-danger" lay-event="delete">删除</button>
`;
/* 渲染表格 */
renderTable();
searchRow();
renderPage();

function batch(){
    layui.use(function(){
        var layer = layui.layer;
        var clear = document.getElementById('clear');
        var download = document.getElementById('download');
        clear.onclick = function(){
            layer.confirm("你确认要执行此操作吗？",{icon: 3, title:'警告'},()=>{
                ajax('/' + modelName + '/clear',  true, function(response) {
                    response = JSON.parse(response);
                    if (response.code === 0) {
                        layer.msg(response.msg,{icon: 1, time: 1000},()=>{
                            window.location.reload();
                        });
                    } else {
                        layer.msg(response.msg,{icon: 2, time: 1000});
                    }
                });
            });
        };
        download.onclick = function(){
            window.location.href = '/' + modelName + '/download';
        };
    });
}


batch();
rowToolbar(); 