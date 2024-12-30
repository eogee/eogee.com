/**
 * carousel 列表页js
 */
tableHeadSet();// 表头设置            
tableHeadData();// 表格及字段数据

/* 表头字段 */
var hides = ['perimissionId','deleted_at','updated_at'];
var sorts = ['sort','created_at'];
var cols = generateColumns(tableFiledComment, hides, sorts, handleColwidth);

renderRtn(true);
renderTable();
searchRow(); 
renderPage();
insertRow(); 
batch();
rowToolbar(); 