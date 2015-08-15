<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 13.05.2015
 * Time: 16:28
 */
?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/sliderMainpage.js"></script>

<script>
    var width=0;
    if (self.screen)
    {
        width = screen.width
    }
    var key = document.getElementById('enter_button');
    var nav = document.getElementById('navigation');
    var logo = document.getElementById('logo_img');
    var border = document.getElementById('button_border');
    var lang = document.getElementById('lang');
    var underline = document.getElementById('headerUnderline');
    var but = document.getElementById('enterButton');
    var logolang = "<?php
    $app = Yii::app();
    switch ($app->session['lg']){
                    case 'ua':
                        echo StaticFilesHelper::createPath('image', 'mainpage', 'Logo_bigUA.png');
                        break;
                    case 'en':
                        echo StaticFilesHelper::createPath('image', 'mainpage', 'Logo_bigEN.png');
                        break;
                    case 'ru':
                       echo StaticFilesHelper::createPath('image', 'mainpage', 'Logo_bigRU.png');
                        break;
                    default:
                        echo StaticFilesHelper::createPath('image', 'mainpage', 'Logo_bigUA.png');
                        break;
                }
                ?>";
    key.className = "";
    nav.className = "";
    logo.className = "";
    border.className = "";
    lang.className = "";
    underline.className = "downmain";
    but.className = "";
    document.getElementById('logo').src=logolang;
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

<div id="sliderCenterBox">
    <div class="sliderCenterBoxText">
        <p><?php echo Yii::t('slider','0005'); ?></p>
    </div>
    <div class="sliderCenterBoxLine">
        <hr>
    </div>
    <div class="sliderSnake">
        <div class="snake">
            <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'line.png'); ?>">
        </div>
        <?php if(Yii::app()->user->isGuest) {
            ?>
        <div class="button">
            <a class="sliderButton" href="#form"><?php echo Yii::t('slider', '0008'); ?></a>
        </div>
        <?php
        }
        ?>
    </div>
</div>
<div id="slider" class="owl-carousel">
    <div class="slide">
        <div>
            <p><?php echo Yii::t('slider','0027'); ?></p>
            <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', '1.jpg'); ?>" />
        </div>
    </div>
    <div class="slide">
        <div>
            <p><?php echo Yii::t('slider','0028'); ?></p>
            <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', '2.jpg'); ?>" />
        </div>
    </div>
    <div class="slide">
        <div>
            <p><?php echo Yii::t('slider','0029'); ?></p>
            <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', '3.jpg'); ?>" />
        </div>
    </div>
    <div class="slide">
        <div>
            <p><?php echo Yii::t('slider','0030'); ?></p>
            <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', '4.jpg'); ?>" />
        </div>
    </div>
    <div class="slide">
        <div>
            <p><?php echo Yii::t('slider','0559'); ?></p>
            <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', '9.jpg'); ?>" />
        </div>
    </div>
    <div class="slide">
        <div>
            <p><?php echo Yii::t('slider','0560'); ?></p>
            <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', '10.jpg'); ?>" />
        </div>
    </div>
</div>
<div class="mouseLine">
    <a id="mouseLine" <?php echo AccessHelper::LinkInMouseLine(); ?>><img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'mouseLine.png'); ?>"/></a>
</div>