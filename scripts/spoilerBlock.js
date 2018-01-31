/**
 * Created by Ivanna on 11.05.2015.
 */
function wrt(x)
{
    $(".razv").html(x);
}
/**
 * Created by Ivanna on 08.05.2015.
 * */
var date = new Date();
date.setMonth(date.getMonth()+1);

$('#enter_button').click(function () {
    document.cookie = "displayBlock=true;expires="+date;
});

if(!getCookie('displayBlock')){
    document.cookie = "displayBlock=true;expires="+date;
}

function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : false;
}

function checkShowingBlockInCourses() {
    var blockStatus = getCookie('displayBlock');
    if (blockStatus == 'false') {
        $(".bgBlue").hide();
    }
    else if(blockStatus=='true' && $(document).width()>800){
        $(".rightColumn .bgBlue").show();
        $(".leftColumn .bgBlue").hide();
    }
    if(blockStatus=='true' && $(document).width()<=800){
        $(".leftColumn .bgBlue").show();
        $(".rightColumn .bgBlue").hide();
    }
}

checkShowingBlockInCourses();

window.addEventListener("resize", function() {
    checkShowingBlockInCourses();
}, false);
window.addEventListener("orientationchange", function() {
    checkShowingBlockInCourses();
}, false);

function xexx()
{
    $('.bgBlue').hide();
    document.cookie = "displayBlock=false;expires="+date;
}
function courseTypeSpoiler(el) {
    if ($('#typeList').css('display')=='none') {
        $('#trg').text("\u25B2");
    }
    if($('#typeList').css('display')=='block'){
        $('#trg').text("\u25BC");
    }
    $('#typeList').toggle('normal');
    return false;
};