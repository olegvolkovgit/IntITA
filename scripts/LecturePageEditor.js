
function deletePage(lecture, page, course){
    if($("div.labelBlock").length==1){
        bootbox.alert("Ви не можете видалити останню сторінку")
        return false;
    }
    bootbox.confirm("Ви впевнені, що хочете видалити цей блок?", function(result){
        if(result){
            $.ajax({
                type: "POST",
                url: basePath + "/lesson/deletePage",
                data: {'idLecture': lecture, 'pageOrder': page},
                success: function () {
                    location.reload();
                }
            });
        };
    });
}

function upPage(idLecture, pageOrder, course){
    $.ajax({
        type: "POST",
        url: basePath+"/lesson/upPage",
        data: {'idLecture':idLecture, 'pageOrder':pageOrder, 'idCourse':course},
        success: function(){
            location.reload();
        }
    });
}


function downPage(idLecture, pageOrder, course){
    $.ajax({
        type: "POST",
        url: basePath+"/lesson/downPage",
        data: {'idLecture':idLecture, 'pageOrder':pageOrder, 'idCourse':course},
        success: function(){
            location.reload();
        }
    });
}

function upBlock(idLecture, order) {
    $.ajax({
        type: "POST",
        url: basePath+"/revision/upElement",
        data: {'idLecture': idLecture, 'order': order},
        success: function () {
            $.fn.yiiListView.update('blocks_list', {
                complete: function () {
                    loadRedactorJs();
                }
            });
            return false;
        }
    });
}

function downBlock(idLecture, order) {
    $.ajax({
        type: "POST",
        url: basePath+"/revision/downElement",
        data: {'idLecture': idLecture, 'order': order},
        success: function () {
            $.fn.yiiListView.update('blocks_list', {
                complete: function () {
                    loadRedactorJs();
                }
            });
            return false;
        }
    });
}

function deleteBlock(idLecture, order) {
    if(confirm("Ви впевнені, що хочете видалити цей блок?")) {
        $.ajax({
            type: "POST",
            url: basePath+"/revision/deleteElement",
            data: {'idLecture': idLecture, 'order': order},
            success: function () {
                $.fn.yiiListView.update('blocks_list', {
                    complete: function () {
                        loadRedactorJs();
                    }
                });
                return false;
            }
        });
    }
}
function deleteVideo(idLecture, pageOrder) {
    bootbox.confirm("Ви впевнені, що хочете видалити цей блок?", function(result){
        if(result){
            $.ajax({
                type: "POST",
                url: basePath+"/revision/deleteVideo",
                data: {'idLecture': idLecture, 'pageOrder': pageOrder},
                success: function () {
                    location.reload();
                    return false;
                }
            });
        };
    })
}