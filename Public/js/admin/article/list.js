tableHeadSet(); // 表头设置
tableHeadData();// 表格及字段数据

/* 表头字段 */
var hides = [
    'content',
    'authorId',
    'authorNickname',
    'categoryId',
    'created_at',
    'updated_at',
    'deleted_at'
];
var sorts = [
    'sort'
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