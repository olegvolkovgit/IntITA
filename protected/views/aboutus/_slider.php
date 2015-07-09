
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/sliderAboutUs.js"</script>

<script>
    var width=0;
    if (self.screen)
    {
        width = screen.width
    }
    function centerPage()
    {
        $('.contentCenterBox').css('width', width);
        //$('.contentCenterBox').css('left', "50%");
        //$('.contentCenterBox').css('margin-left', -width/2);
    }
//    var key = document.getElementById('enter_button');
//    var nav = document.getElementById('navigation');
//    var logo = document.getElementById('logo_img');
//    var border = document.getElementById('button_border');
//    var lang = document.getElementById('lang');
//    var underline = document.getElementById('headerUnderline');
//    var but = document.getElementById('enterButton');
//    var logolang = "<?php
//    $app = Yii::app();
//    switch ($app->session['lg']){
//                    case 'ua':
//                        echo StaticFilesHelper::createPath('image', 'mainpage', 'Logo_bigUA.png');
//                        break;
//                    case 'en':
//                        echo StaticFilesHelper::createPath('image', 'mainpage', 'Logo_bigEN.png');
//                        break;
//                    case 'ru':
//                       echo StaticFilesHelper::createPath('image', 'mainpage', 'Logo_bigRU.png');
//                        break;
//                    default:
//                        echo StaticFilesHelper::createPath('image', 'mainpage', 'Logo_bigUA.png');
//                        break;
//                }
//                ?>//";
//    key.className = "";
//    nav.className = "";
//    logo.className = "";
//    border.className = "";
//    lang.className = "";
//    underline.className = "";
//    but.className = "";
//    document.getElementById('logo').src=logolang;
//    window.onscroll = function() {
//        var pageY = window.pageYOffset || document.documentElement.scrollTop;
//        if (pageY >= key.offsetHeight) {
//            document.getElementById('logo').src="<?php //echo StaticFilesHelper::createPath('image', 'mainpage', 'Logo_small.png');?>//";
//            key.className = "downmain";
//            logo.className = "downmain";
//            nav.className = "downmain";
//            border.className = "downmain";
//            lang.className = "downmain";
//            underline.className = "downmain";
//            but.className = "downmain";
//        } else {
//            document.getElementById('logo').src=logolang;
//            border.className = "";
//            key.className = "";
//            logo.className = "";
//            nav.className = "";
//            lang.className = "";
//            underline.className = "";
//            but.className = "";
//        }
//    }
</script>
<body onload="centerPage()">

<div class="aboutusslider">
<div id="slider" class="owl-carousel">
    <div class="slideAbout">
            <div class="about1">
                ПРО ЩО МРІЄШ ТИ?
                <div class="sliderCenterBoxLine">
                    <hr>
                </div>
                <div class="textabout">
                    Спробуємо вгадати: власна квартира чи навіть будинок? Гарний автомобіль? Закордонні подорожі, можливо, до екзотичних країн?
                </div>
            </div>
        <img src="<?php echo StaticFilesHelper::createPath('image', 'aboutus', '1.jpg'); ?>" />
    </div>
    <div class="slideAbout">
        <div class="about">
            <div class="about2">
                ПРО ЩО МРІЄШ ТИ?
                <div class="sliderCenterBoxLine">
                    <hr>
                </div>
                <div class="textabout">
                    Закордонні подорожі, до екзотичних країн з коханою людиною? Небезпечні єкскурсії
                </div>
            </div>
        </div>
        <img src="<?php echo StaticFilesHelper::createPath('image', 'aboutus', '2.jpg'); ?>"/>
    </div>
    <div class="slideAbout">
        <div class="about">
            <div class="about3">
                ПРО ЩО МРІЄШ ТИ?
                <div class="sliderCenterBoxLine">
                    <hr>
                </div>
                <div class="textabout">
                    Закордонні подорожі, до екзотичних країн з коханою людиною? Небезпечні єкскурсії
                </div>
            </div>
        </div>
        <img src="<?php echo StaticFilesHelper::createPath('image', 'aboutus', '3.jpg'); ?>"/>
    </div>
    <div class="slideAbout">
            <div class="about4">
                ПРО ЩО МРІЄШ ТИ?
                <div class="sliderCenterBoxLine">
                    <hr>
                </div>
                <div class="textabout">
                    Закордонні подорожі, до екзотичних країн з коханою людиною? Небезпечні єкскурсії
                </div>
            </div>
        <img src="<?php echo StaticFilesHelper::createPath('image', 'aboutus', '4.jpg'); ?>"/>
    </div>
</div>
</div>