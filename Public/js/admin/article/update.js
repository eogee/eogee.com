ajax('/'+modelName+'/updateApi/'+tableId,false,function(response){
    tableData = JSON.parse(response);
});

pushField();

if(pageName == 'edit'){
    pushData(
        /* You can add the form item here which isn't need to be auto updated */
    );
}

// upload('YouFileId','/article/fileUploadApi/'+tableId); // 上传图片，如涉及可解除注释