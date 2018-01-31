/**
 * Created by Ivanna on 08.05.2015.
 * */
var date = new Date();
date.setMonth(date.getMonth()+1);

$('#enter_button').click(function () {
    document.cookie = "displayBlockTeachers=true;expires="+date;
});

if(!getCookie('displayBlockTeachers')){
    document.cookie = "displayBlockTeachers=true;expires="+date;
}

function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
        return matches ? decodeURIComponent(matches[1]) : false;
}

function checkShowingBlockInTeachers() {
    var blockStatus = getCookie('displayBlockTeachers');
    if (blockStatus == 'false') {
        $(".teacherForm").hide();
    }
    else if(blockStatus=='true' && $(document).width()>800){
        $(".two .teacherForm").show();
        $(".one .teacherForm").hide();
    }
    if(blockStatus=='true' && $(document).width()<=800){
        $(".one .teacherForm").show();
        $(".two .teacherForm").hide();
    }
}

checkShowingBlockInTeachers();

window.addEventListener("resize", function() {
    checkShowingBlockInTeachers();
}, false);
window.addEventListener("orientationchange", function() {
    checkShowingBlockInTeachers();
}, false);

function xexx()
{
    $('.teacherForm').hide();
    document.cookie = "displayBlockTeachers=false;expires="+date;
}