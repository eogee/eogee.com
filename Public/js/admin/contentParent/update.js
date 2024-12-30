ajax('/'+modelName+'/updateApi/'+tableId,false,function(response){
    tableData = JSON.parse(response);
});

pushField();

if(pageName == 'edit'){
    pushData(['backgroundImage']);
    document.getElementById('backgroundImageImg').src = tableData.data.backgroundImage;
    var parentId = tableData.data.id;//父级id
}
if(pageName == 'insert'){
    var parentId = 0;//父级id
}

upload('backgroundImage','/contentParent/fileUploadApi/'+tableId);