/**
 * Created by Wizlight on 17.09.2015.
 */
$(document).ready(function(){
    if($.cookie('openEditTab')) $(".tabs").lightTabs($.cookie('openEditTab'),'edit');
    else{
        $(".tabs").lightTabs(0,'edit');
    }
});