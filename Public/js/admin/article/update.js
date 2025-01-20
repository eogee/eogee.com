ajax('/'+modelName+'/updateApi/'+tableId,false,function(response){
    tableData = JSON.parse(response);
});

pushField();

/* 填充文章下拉框选项 */
populateSelectOptions('categoryIdSelect', tableData.options);

/* 渲染编辑数值 */
if(pageName == 'edit'){
    pushData([
        'content'
        ,'authorId'
        ,'authorNickname'
        ,'authorUsername'
    ]);
    document.getElementById('content').children[0].value = tableData.data.content;
}

/* 渲染默认信息 */
document.getElementById('authorId').children[1].children[0].value = tableData.authorId;
document.getElementById('authorNickname').children[1].children[0].value = tableData.authorNickname;
document.getElementById('authorUsername').children[1].children[0].value = tableData.authorUsername;

