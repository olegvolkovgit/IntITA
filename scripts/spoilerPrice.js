/**
 Спойлер змісту і іншого контента
 */
$(document).ready(function(){
    $('.spoilerLinks').click(function(){
        if ($('.spoilerRow')[0].style.display=='table-row'){
            $('.spoilerTriangle').text("\u25BC");
        }else{
            $('.spoilerTriangle').text("\u25B2");
        }
        $('.spoilerRow').toggle('normal');
        return false;
    });
});