/**
 * Created by Ivanna on 13.05.2015.
 */
$(function(){
    $('.owl-item').height(document.body.clientWidth/3);
    $(window).resize(function(){
        $('.owl-item').height(document.body.clientWidth/3);
    });
});
function textSliderCentr(count) { /* Центрування тексту картинки слайдеру*/
    for(var i=1;i<=count;i++){
        var elHalfWidth=$('.about'+i).css('width').slice(0, -2)/2;
        $('.about'+i).css('margin-left', (document.body.clientWidth*$('.about'+i).attr('left')/100-elHalfWidth)+'px');
    }
}

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