tableHeadSet(); // 表头设置
tableHeadData();// 表格及字段数据

/* 表头字段 */
var hides = [
    /* You can add the hide column name here */
];
var sorts = [
    /* You can add the sort column name here */
];

/* 表格及字段数据 */
var cols = generateColumns(tableFiledComment, hides, sorts, handleColwidth);

/* 表格渲染 */
renderRtn(true);
renderTable();
searchRow(); 
renderPage();
insertRow(); 
batch();
rowToolbar(); 