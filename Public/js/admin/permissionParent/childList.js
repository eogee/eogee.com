modelName = 'permission';
pageName = 'list';

ajax('/'+modelName+'/tableHeadDataApi', false,function(response) {
    response = JSON.parse(response);
    tableFiledComment = response.tableFiledComment;
});

handleColwidth = 166;

/* 表头字段 */
var hides = ['parentId','created_at','updated_at','deleted_at'];
var sorts = ['sort'];
var cols = generateColumns(tableFiledComment, hides, sorts, handleColwidth);

if(parentId!= 0){
    renderRtn(true);
    renderTable(parentId);
    insertRow(parentId);
    rowToolbar();
}