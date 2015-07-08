/**
 * Created by Ivanna on 13.05.2015.
 */
$(function(){
    $('.owl-item').height(document.body.clientWidth/2.18);
    $(window).resize(function(){
        $('.owl-item').height(document.body.clientWidth/2.18);
    });
});
function fontSize() { /* Маштабування тексту слайдера*/
    var width = 1440;
    var fontSize = 42;
    var bodyWidth = $('html').width();
    var multiplier = bodyWidth / width;
    if (document.body.clientWidth <= width)
        fontSize = Math.floor(fontSize * multiplier);
    $('.sliderCenterBoxText').css({fontSize: fontSize+'px'});
    $('.sliderCenterBoxLine').css({fontSize: fontSize+'px'});
    $('#slider').css({fontSize: fontSize+'px'});
    $('.sliderSnake .button ').css({fontSize: fontSize+'px'});
}
$(function() { fontSize(); });
$(window).resize(function() { fontSize(); });
function marginLeft() { /* Маштабування змійки*/
    var pictureWidht=911
    if ( document.body.clientWidth <= 1440 ){
        $('.sliderSnake .snake img').height(document.body.clientWidth*0.675/5.5);
        $('.sliderSnake .snake img').width(document.body.clientWidth*0.675);
        $('.sliderSnake .snake img').css('margin-left', (document.body.clientWidth*0.6/2-document.body.clientWidth*0.6)+'px');
        $('.sliderSnake .snake img').css('left', document.body.clientWidth/1.98+'px' );

    }else {
        $('.sliderSnake .snake img').height('auto');
        $('.sliderSnake .snake img').width('1010px');
        $('.sliderSnake .snake img').css('margin-left', (1161/2-1161)+'px');
        $('.sliderSnake .snake img').css('left', document.body.clientWidth/1.98+130+'px' );

    }
}
$(function() { marginLeft(); });
$(window).resize(function() { marginLeft(); });

function textSliderCentr() { /* Центрування тексту картинки слайдеру*/
    $('.slide p').width(document.body.clientWidth);
    $('.slide p').css('margin-left', (document.body.clientWidth/2-document.body.clientWidth)+'px');
    $('.slide p').css('top', document.body.clientWidth/4.05+'px');
    $('.slide p.about').css('top', document.body.clientWidth/10+'px');
}
$(function() { textSliderCentr(); });
$(window).resize(function() { textSliderCentr(); });

function sliderBoxCentr() { /* Центрування центрального боксу слайдера*/
    if ( document.body.clientWidth <= 1440 ){
        $('#sliderCenterBox').css('margin-top', document.body.clientWidth/3/2+'px');
    } else {
        $('#sliderCenterBox').css('margin-top', document.body.clientWidth/4.05-120+'px');
    }
}
$(function() { sliderBoxCentr(); });
$(window).resize(function() { sliderBoxCentr(); });

function sliderButtonSize() { /* Розмір кнопки на слайдері*/
    if ( document.body.clientWidth <= 1440 ){
        $('.sliderSnake .button a').css('margin-left', (document.body.clientWidth*0.11/2-document.body.clientWidth*0.11)+'px');
        $('.sliderSnake .button a').css('width',document.body.clientWidth*0.12+'px');
        $('.sliderSnake .button a').css('height',document.body.clientWidth/3.2*0.11+'px');
    } else {
        $('.sliderSnake .button a').css('margin-left', '-85px')
        $('.sliderSnake .button a').css('width','180px');
        $('.sliderSnake .button a').css('height','50px');
    }
}
$(function() { sliderButtonSize(); });
$(window).resize(function() { sliderButtonSize(); });

function centrSliderButtons() { /* центрування кнопок прокрутки слайдеру*/
    if ( document.body.clientWidth <= 1000){
        $('.owl-controls').css('margin-left', '0')
        $('.owl-controls').css('left', '0')
        $('.owl-controls').css('width', 'auto')
    }else {
        $('.owl-controls').css('margin-left', '-538px');
        $('.owl-controls').css('left', '50%')
        $('.owl-controls').css('width', '200px')
    }
}
$(function() { centrSliderButtons(); });
$(window).resize(function() { centrSliderButtons(); });
function centrMouseLine() { /* Маштабування лінії з мишкою*/
    $('.mouseLine').css('height', document.body.clientWidth/15+'px')
    $('.mouseLine').css('width', document.body.clientWidth+'px')
    $('.mouseLine img').css('height', document.body.clientWidth/15.42+'px')
    $('.mouseLine img').css('width', document.body.clientWidth+'px')
}
$(function() { centrMouseLine(); });
$(window).resize(function() { centrMouseLine(); });