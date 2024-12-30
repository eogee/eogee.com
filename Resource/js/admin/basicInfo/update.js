ajax('/'+modelName+'/updateApi/'+tableId,false,function(response){
    tableData = JSON.parse(response);
});

pushField();
pushData(['titleIcon','logoImage']);

document.getElementById('titleIconImg').src = tableData.data.titleIcon;
document.getElementById('logoImageImg').src = tableData.data.logoImage;

upload('titleIcon','/basicInfo/fileUploadApi','','ico');
upload('logoImage','/basicInfo/fileUploadApi');