ajax('/'+modelName+'/updateApi/'+tableId,false,function(response){
    tableData = JSON.parse(response);
});

pushField();

if(pageName == 'edit'){
    pushData(['backgroundImage']);
    document.getElementById('backgroundImageImg').src = tableData.data.backgroundImage;
}

upload('backgroundImage','/singlePage/fileUploadApi/'+tableId);
