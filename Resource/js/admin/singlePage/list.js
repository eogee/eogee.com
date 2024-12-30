/**
 * carousel 列表页js
 */

tableHeadSet();// 表头设置            
tableHeadData();// 表格及字段数据

/* 表头字段 */
var hides = ['top','inNav','parentId','titleColor','titleShadowColor', 'keywords', 'description', 'backgroundImage','keynoteColor', 'keynoteShadowColor','contentColor', 'contentShadowColor','detail', 'detailColor', 'detailShadowColor', 'newsContent','btn1url', 'btn1blank', 'btn2url', 'btn2blank', 'lastChildId','lastChildTitle','lastChildTitleAbbre', 'lastChildTitleUrl', 'newsDate','enter','enterId','deleted_at'];
var sorts = ['sort'];
var cols = generateColumns(tableFiledComment, hides, sorts, handleColwidth);

renderRtn(true);
renderTable();
searchRow(); 
renderPage();
insertRow(); 
batch();
rowToolbar(); 