modelName = 'log';        
pageName = 'list';

tableHeadSet();// 表头设置
tableHeadData();// 表格及字段数据

/* 表格字段定义 */
var hides = ['userId','statusCode'];
var sorts = [];
var cols = generateColumns(tableFiledComment, hides, sorts, handleColwidth);

/* 表头按钮组定义 */
var toolbar = document.getElementById("toolbar");
toolbar.innerHTML = `
    <button id="deleteBatch" class="layui-btn layui-btn-danger layui-btn-sm" lay-event="deleteBatch">批量删除</button>`;
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
batch();
rowToolbar(); 