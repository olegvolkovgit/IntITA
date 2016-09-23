/**
 * Created by Wizlight on 28.07.2015.
 */

function rocketMove(element,w) {
    element.animate({
        top:-$('#rocket').height(),
        left:w
    }, 3000);

    setTimeout(function () {
        $('#exhaust').hide();
    }, 500);
    setTimeout(function () {
        $('#rocket').hide();
    }, 3000);
}

function goUp(){
    var hPosR=$(document).outerHeight()-($('#rocket').height()+$('#exhaust').height());
    var wPosR=$(document).outerWidth()/2-$(window).width()*0.225;
    var hPosE=$(document).outerHeight()-$('#exhaust').height();
    var wPosE=$(document).outerWidth()/2-$(window).width()*0.4167;
    $('#rocket').show();
    $('#rocket').offset({top:hPosR, left:wPosR});
    $('#exhaust').show();
    $('#exhaust').offset({top:hPosE, left:wPosE});

    $('body,html').animate({scrollTop: 0}, 2700);
    rocketMove($('#rocket'),wPosR);
};
