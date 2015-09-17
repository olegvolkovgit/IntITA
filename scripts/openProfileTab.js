/**
 * Created by Wizlight on 17.09.2015.
 */
$(document).ready(function(){
    if($.cookie('openProfileTab')) $(".tabs").lightTabs($.cookie('openProfileTab'),'profile');
    else{
        $(".tabs").lightTabs(0,'profile');
    }
});