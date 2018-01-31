/**
 * Created by Ivanna on 08.05.2015.
 */
function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }
function checkShowingBlockInTeachers() {
    var blockStatus = getCookie('displayBlockTeachers');
    if (blockStatus == 'false') {
        $('.teacherForm').hide();
    }
}
checkShowingBlockInTeachers();

function xexx()
{
    $('.teacherForm').hide();
    document.cookie = "displayBlockTeachers=false;expires=0;";
}
