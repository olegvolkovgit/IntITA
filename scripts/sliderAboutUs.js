/**
 * Created by Ivanna on 13.05.2015.
 */
$(function(){
    $('.owl-item').height(document.body.clientWidth/3);
    $(window).resize(function(){
        $('.owl-item').height(document.body.clientWidth/3);
    });
});
function textSliderCentr() { /* Центрування тексту картинки слайдеру*/
    $('.about1').css('margin-left', (document.body.clientWidth*0.2)+'px');
    $('.about2').css('margin-left', -(document.body.clientWidth*0.2)+'px');
    $('.about3').css('margin-left', -(document.body.clientWidth*0.05)+'px');
    $('.about4').css('margin-left', -(document.body.clientWidth*0.3)+'px');
    $('.about1').width(document.body.clientWidth);
    $('.about2').width(document.body.clientWidth);
    $('.about3').width(document.body.clientWidth);
    $('.about4').width(document.body.clientWidth);
    $('.about5').width(document.body.clientWidth);
    $('.about6').width(document.body.clientWidth);
}
$(function() { textSliderCentr(); });
$(window).resize(function() { textSliderCentr(); });

function sliderBoxCentr() { /* Центрування центрального боксу слайдера*/
    $('#sliderCenterBox').css('margin-top', document.body.clientWidth/3/2+'px');
}
$(function() { sliderBoxCentr(); });
$(window).resize(function() { sliderBoxCentr(); });


function centrSliderButtons() { /* центрування кнопок прокрутки слайдеру*/
    $('.owl-controls').css('margin-left', '0');
    $('.owl-controls').css('left', '8%');
    $('.owl-controls').css('width', 'auto');
}
$(function() { centrSliderButtons(); });
$(window).resize(function() { centrSliderButtons(); });
