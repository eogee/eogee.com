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

// upload('YouFileId','/article/fileUploadApi/'+tableId); // 上传图片，如涉及可解除注释