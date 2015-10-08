/**
 * Created by Ivanna on 13.05.2015.
 */
$(function(){
    $('.owl-item').height(document.body.clientWidth/2.18);
    $(window).resize(function(){
        $('.owl-item').height(document.body.clientWidth/2.18);
    });
});
//function fontSize() { /* Маштабування тексту слайдера*/
    //var width = 1440;
    //var fontSize = 42;
    //var bodyWidth = $('html').width();
    //var multiplier = bodyWidth / width;
    //fontSize = Math.floor(fontSize * multiplier);
    //$('.sliderCenterBoxText').css({fontSize: fontSize+'px'});
    //$('.sliderCenterBoxLine').css({fontSize: fontSize+'px'});
    //$('#slider').css({fontSize: fontSize+'px'});
    //$('.sliderSnake .button ').css({fontSize: fontSize+'px'});
//}
//$(function() { fontSize(); });
//$(window).resize(function() { fontSize(); });
//function marginLeft() { /* Маштабування змійки*/
    //var pictureWidht=911
        //$('.sliderSnake .snake img').height(document.body.clientWidth*0.675/5.5);
        //$('.sliderSnake .snake img').width(document.body.clientWidth*0.675);
        //$('.sliderSnake .snake img').css('margin-left', (document.body.clientWidth*0.6/2-document.body.clientWidth*0.6)+'px');
        //$('.sliderSnake .snake img').css('left', document.body.clientWidth/1.98+'px' );
//}
//$(function() { marginLeft(); });
//$(window).resize(function() { marginLeft(); });

function textSliderCentr() { /* Центрування тексту картинки слайдеру*/
    $('.slide p').width(document.body.clientWidth);
    $('.slide p').css('top', (document.body.clientWidth/3/2)+110+'px');
    if(document.body.clientWidth>=1200){
        $('.slide p.about').css('top', document.body.clientWidth/10+'px');
    }
}
$(function() { textSliderCentr(); });
$(window).resize(function() { textSliderCentr(); });

function sliderBoxCentr() { /* Центрування центрального боксу слайдера*/
    $('#sliderCenterBox').css('margin-top', document.body.clientWidth/3/2+'px');
}
$(function() { sliderBoxCentr(); });
$(window).resize(function() { sliderBoxCentr(); });

//function sliderButtonSize() { /* Розмір кнопки на слайдері*/
//        $('.sliderSnake .button a').css('margin-left', (document.body.clientWidth*0.11/2-document.body.clientWidth*0.11)+'px');
//        $('.sliderSnake .button a').css('width',document.body.clientWidth*0.12+'px');
//        $('.sliderSnake .button a').css('height',document.body.clientWidth/3.2*0.11+'px');
//}
//$(function() { sliderButtonSize(); });
//$(window).resize(function() { sliderButtonSize(); });

function centrSliderButtons() { /* центрування кнопок прокрутки слайдеру*/
        $('.owl-controls').css('margin-left', '0');
        $('.owl-controls').css('left', '5%');
        $('.owl-controls').css('width', 'auto');
}
$(function() { centrSliderButtons(); });
$(window).resize(function() { centrSliderButtons(); });
function centrMouseLine() { /* Маштабування лінії з мишкою*/
    $('.mouseLine').css('height', document.body.clientWidth/15+'px');
    $('.mouseLine').css('width', document.body.clientWidth+'px');
    $('.mouseLine img').css('height', document.body.clientWidth/15+'px');
    $('.mouseLine img').css('width', document.body.clientWidth+'px');
    if(document.body.clientWidth<1200) $('.mouseLine').css('margin-top', '-30px');
    else $('.mouseLine').css('margin-top', '-2.55%');
}
$(function() { centrMouseLine(); });
$(window).resize(function() { centrMouseLine(); });