/**
 * carousel 列表页js
 */

tableHeadSet();// 表头设置            
tableHeadData();// 表格及字段数据

/* 表头设置 */
var hides = ['colorCode', 'blank','deleted_at'];
var sorts = ['sort'];
var cols = generateColumns(tableFiledComment, hides, sorts, handleColwidth);
renderRtn(true);
renderTable();
searchRow(); 
renderPage();
insertRow(); 
batch();
rowToolbar(); 