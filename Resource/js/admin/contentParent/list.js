/**
 * contentParent list js
 */
tableHeadSet();// 表头设置
tableHeadData();// 表格及字段数据

/* 表头设置 */
var hides = ['isNews','top','style','titleAbbre', 'titleColor','titleShadowColor', 'keywords', 'description', 'backgroundImage','keynoteColor', 'keynoteShadowColor','lastChildTitle','lastChildTitleAbbre', 'lastChildTitleUrl', 'deleted_at'];
var sorts = ['sort'];
var cols = generateColumns(tableFiledComment, hides, sorts, handleColwidth);

renderRtn(true);
renderTable();
searchRow();
renderPage();
insertRow();
batch();
rowToolbar(); 