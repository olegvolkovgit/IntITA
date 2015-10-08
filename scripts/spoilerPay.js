/**
 * Created by Wizlight on 02.06.2015.
 */
/**-------Спойлер ціни курсу--------*/
function paymentSpoiler(a,b){
        var nameSpoiler = document.getElementById("spoilerClick").innerHTML;
        if(nameSpoiler==a){
            document.getElementById("spoilerClick").innerHTML=b;
            document.getElementById("spoilerTriangle").innerHTML="\u25B2";
        } else if(nameSpoiler==b){
            document.getElementById("spoilerClick").innerHTML=a;
            document.getElementById("spoilerTriangle").innerHTML="\u25BC";
        }
        $('#firstRadio').toggle('normal');
        $('.spoilerBody').toggle('normal');
        return false;
    }
$(document).ready(function () {
    $('html').on('click','.paymentPlan_value',function () {
        $('img.icoCheck').hide();
        $('img.icoNoCheck').show();
        $(this).next('span').find('img.icoNoCheck').hide();
        $(this).next('span').find('img.icoCheck').show();
    });
    $.fn.fancyzoom.defaultsOptions.imgDir='/scripts/fancyzoom/ressources/';
    $("#demo > a").fancyzoom();
});

function showSchema(){
        document.getElementById("schema").style.display = "block";
}

