/**
 * 网站基本信息basicInfo list.js
 */
tableHeadSet();// 表头设置
tableHeadData();// 表格及字段数据

ajax('/'+modelName+'/listApi',false, function(response) {
    response = JSON.parse(response);
    tableData = response.data;
});
// 单行表格渲染
oneLineTableRender(tableFiledComment, tableData);

id = tableData[0].id;    
editTable();//编辑表格数据