function deletePhoto(url,id,name){
    bootbox.confirm('Ви впевнені, що хочете видалити фото випускника ' + name + '?', function (result) {
        if(result){
            $.ajax({
                type: "POST",
                url: url,
                data: {'id': id},
                cache: false,
                success: function (data) {
                    if(data == true) {
                        bootbox.alert("Фото " + name + " видалено!");
                    }
                }
            });
        }
    });
}