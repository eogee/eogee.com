modelName = 'content';
pageName = 'list';

ajax('/'+modelName+'/tableHeadDataApi', false,function(response) {
    response = JSON.parse(response);
    tableFiledComment = response.tableFiledComment;
});

handleColwidth = 166;

/* 表头字段 */
var hides = ['top','parentId','titleAbbre', 'titleColor','titleShadowColor', 'keywords', 'description', 'backgroundImage','keynoteColor', 'keynoteShadowColor','content','contentColor', 'contentShadowColor','detail', 'detailColor', 'detailShadowColor', 'newsContent','btn1url', 'btn1blank', 'btn2url', 'btn2blank', 'lastChildId','lastChildTitle','lastChildTitleAbbre', 'lastChildTitleUrl', 'isNews','newsDate','enter','enterId','deleted_at'];
var sorts = ['sort'];
var cols = generateColumns(tableFiledComment, hides, sorts, handleColwidth);

if(parentId!= 0){
    renderRtn(true);
    renderTable(parentId);
    insertRow(parentId);
    rowToolbar();
}