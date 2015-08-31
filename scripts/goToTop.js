/**
 * Created by Wizlight on 28.07.2015.
 */
/*рух ракети вгору і зникання вихлопу*/
function rocketMove(element,w) {
    element.animate({
        top:-250,
        left:w
    }, 3000);

    setTimeout(function () {
        $('#exhaust').hide();
    }, 500);
}
/*Якщо на сторінці є ракета - запускаємо її, якщо нема - скролимся вгору*/
function goUp(){
        var hPosR=$(document).outerHeight()-375;
        var wPosR=$(document).outerWidth()/2-300;
        var hPosE=$(document).outerHeight()-200;
        var wPosE=$(document).outerWidth()/2-445;
        $('#rocket').offset({top:hPosR, left:wPosR});
        $('#exhaust').show();
        $('#exhaust').offset({top:hPosE, left:wPosE});

        $('#rocket').show();

        $('body,html').animate({scrollTop: 0}, 2500);
        rocketMove($('#rocket'),wPosR);
};
