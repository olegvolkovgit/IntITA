function deletePhoto(id, name){
    if (confirm('Ви впевнені, що хочете видалити фото випускника ' + name + '?')){
        $.ajax({
            type: "POST",
            url: "/IntITA/_admin/graduate/deletePhoto",
            data: {'id': id},
            cache: false,
            success: function (data) {
                if(data == true) {
                    alert("Фото " + name + " видалено!");
                }
            }
        });
    }
}