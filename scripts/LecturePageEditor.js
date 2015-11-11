
function deletePage(lecture, page, course){
    if($("div.labelBlock").length==1){
        alert('Ви не можете видалити останню сторінку');
        return false;
    }
    if (confirm('Ви впевнені, що хочете видалити частину ' + page + '?')) {
        $.ajax({
            type: "POST",
            url: "/lesson/deletePage",
            data: {'idLecture':lecture, 'pageOrder':page},
            success: function(){
                location.reload();
            }
        });
    }
}

function upPage(idLecture, pageOrder, course){
    $.ajax({
        type: "POST",
        url: "/lesson/upPage",
        data: {'idLecture':idLecture, 'pageOrder':pageOrder, 'idCourse':course},
        success: function(){
            location.reload();
        }
    });
}


function downPage(idLecture, pageOrder, course){
    $.ajax({
        type: "POST",
        url: "/lesson/downPage",
        data: {'idLecture':idLecture, 'pageOrder':pageOrder, 'idCourse':course},
        success: function(){
            location.reload();
        }
    });
}
//
//function upBlock(idLecture, order) {
//    $.ajax({
//        type: "POST",
//        url: "/lesson/upElement",
//        data: {'idLecture': idLecture, 'order': order},
//        success: function () {
//            $.fn.yiiListView.update('blocks_list', {
//                complete: function () {
//                    loadRedactorJs();
//                }
//            });
//            return false;
//        }
//    });
//}
//
//function downBlock(idLecture, order) {
//    $.ajax({
//        type: "POST",
//        url: "/lesson/downElement",
//        data: {'idLecture': idLecture, 'order': order},
//        success: function () {
//            $.fn.yiiListView.update('blocks_list', {
//                complete: function () {
//                    loadRedactorJs();
//                }
//            });
//            return false;
//        }
//    });
//}
//
//function deleteBlock(idLecture, order) {
//    if(confirm("Ви впевнені, що хочете видалити цей блок?")) {
//        $.ajax({
//            type: "POST",
//            url: "/lesson/deleteElement",
//            data: {'idLecture': idLecture, 'order': order},
//            success: function () {
//                $.fn.yiiListView.update('blocks_list', {
//                    complete: function () {
//                        loadRedactorJs();
//                    }
//                });
//                return false;
//            }
//        });
//    }
//}
function deleteVideo(idLecture, pageOrder) {
    if(confirm("Ви впевнені, що хочете видалити цей блок?")) {
        $.ajax({
            type: "POST",
            url: "/lesson/deleteVideo",
            data: {'idLecture': idLecture, 'pageOrder': pageOrder},
            success: function () {
               location.reload();
                return false;
            }
        });
    }
}