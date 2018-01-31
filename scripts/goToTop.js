/**
 * Created by Wizlight on 28.07.2015.
 */

;(function(){

    var tail_img_1;
    var tail_img_2;
    var rock_img;
    var exh_img_1;
    var rock_div;
    var exh_div;

    $('div .rightfooter a').click(goUp);

    function goUp(){
        var SCROLL_DURATION = $(document).height()*0.9;
        var ANIM_DURATION = $(document).height();

        prepare_elements();

        allocate_animation();

        set_tail_animation(tail_img_1, ANIM_DURATION, 50, 75);
        set_tail_animation(tail_img_2, ANIM_DURATION, 50, 75);

        set_exhaust_animation(1, 300);

        // $('body,html').animate({scrollTop: 0}, SCROLL_DURATION);
        rocketMove(rock_div, ANIM_DURATION);
    }

    function prepare_elements(){
        rock_div = $('#rocket_div');
        exh_div = $('#exhaust_div');

        rock_div.show();
        exh_div.show();

        tail_img_1 = $('#pad_1');
        tail_img_2 = $('#pad_2');
        rock_img = $('#rocket');
        exh_img_1 = $('#exhaust_1');

        tail_img_2.hide();
    }

    function allocate_animation(){
        var horizBorder;
        var vPosExh;
        var vPosRoc;
        var horizQuarter;
        var hPosExh;
        var hPosRoc;

        var rock_hight = rock_img.height();
        var rock_width = rock_img.width();
        var exh_hight = exh_img_1.height();
        var exh_width = exh_img_1.width();

        if(rock_div.css("left") != "0px"){
            vertBorder = $(document).height();
        }else{
            vertBorder = $(document).height() - Math.max(exh_hight, rock_hight);
        }

        horizQuarter = $(window).outerWidth()/4;
        vPosExh = vertBorder - exh_hight - 15;
        vPosRoc = vPosExh - rock_hight;
        hPosExh = horizQuarter - exh_width/2;
        hPosRoc = horizQuarter - rock_width/2;

        rock_div.offset({top:vPosRoc, left:hPosRoc});
        exh_div.offset({top:vPosExh, left:hPosExh});
    }

    function set_tail_animation(elem, duration, min_step, max_step){
        var cur_time;
        var step;

        for(cur_time = 0; cur_time < duration;){
            switch_visiable(elem, cur_time, 50);

            step = min_step + Math.random() * (max_step + 1 - min_step);
            step = Math.floor(step);
            cur_time += step;
        }

        setTimeout(function () {
            rock_div.hide();
        }, duration);
    }

    function switch_visiable(elem, delay, duration){
        setTimeout(function (){
            elem.fadeToggle(duration, "linear");
        }, delay);
    }

    function set_exhaust_animation(exh_id, step){
        var curr = $('#exhaust_'+exh_id);
        var next = $('#exhaust_'+(exh_id+1));

        curr.fadeOut(step*2.2, "swing");
        next.fadeIn(step, "swing", function(){
            if(exh_id < 4){
                set_exhaust_animation(exh_id + 1, step*1.25);
            }else{
                next.fadeOut(step*3, "swing", function(){
                    exh_div.hide();
                });
            }
        });
    }

    function rocketMove(hPosRoc, duration) {
        rock_div.animate({
            top:0-rock_img.height(),
            left:hPosRoc
        }, duration);
    }

}());