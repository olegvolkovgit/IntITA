/**
 * Created by Ivanna on 13.05.2015.
 */
$(function(){
    $('.owl-item').height(document.body.clientWidth/3);
    $(window).resize(function(){
        $('.owl-item').height(document.body.clientWidth/3);
    });
});
function fontSize() { /* Маштабування тексту слайдера*/
    var width = 1440;
    var fontSize = 42;
    var fontHeaderSize = 32;
    var fontTextSize = 18;
    var bodyWidth = $('html').width();
    var multiplier = bodyWidth / width;
    fontHeaderSize = Math.floor(fontHeaderSize * multiplier);
    fontTextSize = Math.floor(fontTextSize * multiplier);
    $('.headerAbout').css({fontSize: fontHeaderSize+'px'});
    $('.sliderCenterBoxLine').css({fontSize: fontHeaderSize+'px'});
    $('.textabout').css({fontSize: fontTextSize+'px'});
    if (document.body.clientWidth <= width)
        fontSize = Math.floor(fontSize * multiplier);
    $('#slider').css({fontSize: fontSize+'px'});
    $('.sliderSnake .button ').css({fontSize: fontSize+'px'});
}
$(function() { fontSize(); });
$(window).resize(function() { fontSize(); });

function textSliderCentr() { /* Центрування тексту картинки слайдеру*/
    $('.slideAbout p').width(document.body.clientWidth);
    $('.slideAbout p').css('margin-left', (document.body.clientWidth/2-document.body.clientWidth)+'px');
    $('.slideAbout p').css('top', document.body.clientWidth/4.05+'px');
    $('.slideAbout p.about').css('top', document.body.clientWidth/10+'px');
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


function centrSliderButtons() { /* центрування кнопок прокрутки слайдеру*/
    if ( document.body.clientWidth <= 1000){
        $('.owl-controls').css('margin-left', '0')
        $('.owl-controls').css('left', '0')
        $('.owl-controls').css('width', 'auto')
    }else {
        $('.owl-controls').css('margin-left', '-620px');
        $('.owl-controls').css('left', '50%')
        $('.owl-controls').css('width', '200px')
    }
}
$(function() { centrSliderButtons(); });
$(window).resize(function() { centrSliderButtons(); });
