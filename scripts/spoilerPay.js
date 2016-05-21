/**
 * Created by Wizlight on 02.06.2015.
 */
/**-------Спойлер ціни курсу--------*/
function paymentSpoiler(a,b, type){
        var nameSpoiler = document.getElementById("spoilerClick" + type).innerHTML;
        if(nameSpoiler==a){
            document.getElementById("spoilerClick" + type).innerHTML=b;
            document.getElementById("spoilerTriangle" + type).innerHTML="\u25B2";
            $('#numbersFirst' + type).hide();
        } else if(nameSpoiler==b){
            document.getElementById("spoilerClick" + type).innerHTML=a;
            document.getElementById("spoilerTriangle" + type).innerHTML="\u25BC";
            $('#numbersFirst' + type).show();
        }
        $('#type').val(type);
        $('#firstRadio' + type).toggle('normal');
        $('.spoilerBody' + type).toggle('normal');
        return false;
    }
$(document).ready(function () {
    $('html').on('click','.paymentPlan_value',function () {
        $('img.icoCheck').hide();
        $('img.icoNoCheck').show();
        $(this).next('span').find('img.icoNoCheck').hide();
        $(this).next('span').find('img.icoCheck').show();
    });
});


