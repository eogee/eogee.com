ajax('/'+modelName+'/updateApi/'+tableId,false,function(response){
    tableData = JSON.parse(response);
});

pushField();

if(pageName == 'edit'){
    pushData();
    var parentId = tableData.data.id;//父级id
}
if(pageName == 'insert'){
    var parentId = 0;//父级id
}