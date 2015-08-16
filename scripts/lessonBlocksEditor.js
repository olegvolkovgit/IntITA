/**
 * Created by Ivanna on 21.05.2015.
 */
//up block on lesson page
function upBlock(idLecture, order){
    $.ajax({
        type: "POST",
        url: "/lesson/upElement",
        data: {'idLecture':idLecture, 'order':order},
        success: function(){
            $.fn.yiiListView.update('blocks_list');
            return false;
        }
    });
}

//down block on lesson page
function downBlock(idLecture, order){
    $.ajax({
        type: "POST",
        url: "/lesson/downElement",
        data: {'idLecture':idLecture, 'order':order},
        success: function(){
            $.fn.yiiListView.update('blocks_list');
            return false;
        }
    });
}

//delete block on lesson page
function deleteBlock(idLecture, order){
    $.ajax({
        type: "POST",
        url: "/lesson/deleteElement",
        data: {'idLecture':idLecture, 'order':order},
        success: function(){
            $.fn.yiiListView.update('blocks_list');
            return false;
        }
    });
}