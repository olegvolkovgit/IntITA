<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 13.05.2015
 * Time: 16:28
 */
?>

<script>
    var width=0;
    if (self.screen)
    {
        width = screen.width
    }
    function centerPage()
    {
        $('.contentCenterBox').css('width', width);
        $('.contentCenterBox').css('left', "50%");
        $('.contentCenterBox').css('margin-left', -width/2);
    }
    var key = document.getElementById('enter_button');
    var nav = document.getElementById('navigation');
    var logo = document.getElementById('logo_img');
    var border = document.getElementById('button_border');
    var lang = document.getElementById('lang');
    var logolang = "<?php
    $app = Yii::app();
    switch ($app->session['lg']){
                    case 'ua':
                        echo Yii::app()->request->baseUrl.'/css/images/Logo_bigUA.png';
                        break;
                    case 'en':
                        echo Yii::app()->request->baseUrl.'/css/images/Logo_bigEN.png';
                        break;
                    case 'ru':
                       echo Yii::app()->request->baseUrl.'/css/images/Logo_bigRU.png';
                        break;
                    default:
                        echo Yii::app()->request->baseUrl.'/css/images/Logo_bigUA.png';
                        break;
                }
                ?>";
    key.className = "";
    nav.className = "";
    logo.className = "";
    border.className = "";
    lang.className = "";
    document.getElementById('logo').src=logolang;
    window.onscroll = function() {
        var pageY = window.pageYOffset || document.documentElement.scrollTop;
        if (pageY >= key.offsetHeight) {
            document.getElementById('logo').src="<?php echo Yii::app()->request->baseUrl;?>/css/images/Logo_small.png";
            key.className = "down";
            logo.className = "down";
            nav.className = "down";
            border.className = "down";
            lang.className = "down";
        } else {
            document.getElementById('logo').src=logolang;
            border.className = "";
            key.className = "";
            logo.className = "";
            nav.className = "";
            lang.className = "";
        }
    }
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
            <img src="<?php echo $mainpage['sliderLine']; ?>">
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
            <img src="<?php echo $slider1 ?>" />
        </div>
    </div>
    <div class="slide">
        <div>
            <p><?php echo Yii::t('slider','0028'); ?></p>
            <img src="<?php echo $slider2 ?>" />
        </div>
    </div>
    <div class="slide">
        <div>
            <p><?php echo Yii::t('slider','0029'); ?></p>
            <img src="<?php echo $slider3 ?>" />
        </div>
    </div>
    <div class="slide">
        <div>
            <p><?php echo Yii::t('slider','0030'); ?></p>
            <img src="<?php echo $slider4 ?>" />
        </div>
    </div>
</div>
<div class="mouseLine">
    <a id="mouseLine" href="#form"><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/slider_img/mouseLine.png"/></a>
</div>