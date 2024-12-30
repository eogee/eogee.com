ajax('/'+modelName+'/updateApi/'+tableId,false,function(response){
    tableData = JSON.parse(response);
});

pushField();

document.getElementById('backgroundImageImg').src = tableData.data.backgroundImage;

pushData(['child1Ids','child2Ids','child3Ids','child4Ids','backgroundImage']);

upload('backgroundImage','/news/fileUploadApi');

