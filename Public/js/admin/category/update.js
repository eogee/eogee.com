ajax('/'+modelName+'/updateApi/'+tableId,false,function(response){
    tableData = JSON.parse(response);
});
pushField();
if(pageName == 'edit'){
    pushData();
}