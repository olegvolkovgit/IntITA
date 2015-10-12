/**
 * Created by Wizlight on 17.07.2015.
 */
$(document).ready(function(){
    if ($(window).scrollTop() > 80) {
        if($(window).height()<$("#hambMenu").height()){
            $("#hambMenu").css("overflow-y", "scroll");
            $("#hambMenu").css({height: 100+'%'});
        }else{
            $("#hambMenu").css("overflow-y", "visible");
            $("#hambMenu").css("height", "inherit");
        }
        $("#hambNav").css({display: "block"});
    }
});

$(window).scroll(function() {
    if ($(window).scrollTop() > 80 ) {
        if($(window).height()<$("#hambMenu").height()){
            $("#hambMenu").css("overflow-y", "scroll");
            $("#hambMenu").css({height: 100+'%'});
        }else{
            $("#hambMenu").css("overflow-y", "visible");
            $("#hambMenu").css("height", "inherit");
        }
        $("#hambNav").css({display: "block"});
    }else{
        $("#defaultHumMenu #hambNav").css({display: "none"});
        $("#defaultHumMenu #hambMenu").hide();
    }
});
//    $(window).resize(function(){
//        if ($(window).width() >= 1200) {
//            $("#hambNav").css({display: "none"})
//        }
//    });
$(document).click(function () {
    $("#hambMenu").hide();
});
$("#hambMenu").click(function (e) {
    e.stopPropagation();
});
$('#hambButton').click(function (e) {
    e.stopPropagation();
    if ($("#hambMenu").css('display') == "none") $("#hambMenu").css({display: "block"});
    else $("#hambMenu").css({display: "none"});
});