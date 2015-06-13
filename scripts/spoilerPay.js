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
        $('.spoilerBody').toggle('normal');
        return false;
    }