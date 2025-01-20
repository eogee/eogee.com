ajax('/'+modelName+'/updateApi/'+tableId,false,function(response){
    tableData = JSON.parse(response);
});

pushField();

if(pageName == 'edit'){
    pushData(
        'content'
    );
    document.getElementById('content').children[0].value = tableData.data.content;
}