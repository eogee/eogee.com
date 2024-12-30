if(pageName == 'insert'){
    ajax('/'+modelName+'/updateApi/insert',false,function(response){
        tableData = JSON.parse(response);
    });
}else{
    ajax('/'+modelName+'/updateApi/'+tableId,false,function(response){
        tableData = JSON.parse(response);
    });
}

if(pageName == 'insert' && tableId){
    document.getElementById('parentId').children[1].children[0].value = tableId;
}

pushField();
pushData();

