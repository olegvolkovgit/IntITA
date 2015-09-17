/**
 * Created by Wizlight on 17.09.2015.
 */
$(document).ready(function(){
    if($.cookie('openRegistrationTab')) $(".tabs").lightTabs($.cookie('openRegistrationTab'),'registration');
    else{
        $(".tabs").lightTabs(0,'registration');
    }
});