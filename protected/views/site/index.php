<body onload="centerPage()">
<?php
/* @var $this SiteController */
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
    key.className = "";
    nav.className = "";
    logo.className = "";
    border.className = "";
    lang.className = "";
    document.getElementById('logo').src="<?php echo $this->logoURL; ?>";
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
            document.getElementById('logo').src="<?php echo $this->logoURL; ?>";
            border.className = "";
            key.className = "";
            logo.className = "";
            nav.className = "";
            lang.className = "";
        }
    }
</script>
<script type="text/javascript"> /* Маштабування слайдера відповідно до ширини екрану*/
    $(function(){
        $('.owl-item').height(document.body.clientWidth/2.18);
        $(window).resize(function(){
            $('.owl-item').height(document.body.clientWidth/2.18);
        });
    });
    function fontSize() { /* Маштабування тексту слайдера*/
        var width = 1440;
        var fontSize = 42;
        var bodyWidth = $('html').width();
        var multiplier = bodyWidth / width;
        if (document.body.clientWidth <= width)
            fontSize = Math.floor(fontSize * multiplier);
        $('.sliderCenterBoxText').css({fontSize: fontSize+'px'});
        $('.sliderCenterBoxLine').css({fontSize: fontSize+'px'});
        $('#slider').css({fontSize: fontSize+'px'});
        $('.sliderSnake .button ').css({fontSize: fontSize+'px'});
    }
    $(function() { fontSize(); });
    $(window).resize(function() { fontSize(); });
    function marginLeft() { /* Маштабування змійки*/
        var pictureWidht=911
        if ( document.body.clientWidth <= 1440 ){
            $('.sliderSnake .snake img').height(document.body.clientWidth*0.675/5.5);
            $('.sliderSnake .snake img').width(document.body.clientWidth*0.675);
            $('.sliderSnake .snake img').css('margin-left', (document.body.clientWidth*0.6/2-document.body.clientWidth*0.6)+'px');
            $('.sliderSnake .snake img').css('left', document.body.clientWidth/1.98+'px' );

        }else {
            $('.sliderSnake .snake img').height('auto');
            $('.sliderSnake .snake img').width('1010px');
            $('.sliderSnake .snake img').css('margin-left', (1161/2-1161)+'px');
            $('.sliderSnake .snake img').css('left', document.body.clientWidth/1.98+130+'px' );

        }
    }
    $(function() { marginLeft(); });
    $(window).resize(function() { marginLeft(); });

    function textSliderCentr() { /* Центрування тексту картинки слайдеру*/
        $('.slide p').width(document.body.clientWidth);
        $('.slide p').css('margin-left', (document.body.clientWidth/2-document.body.clientWidth)+'px');
        $('.slide p').css('top', document.body.clientWidth/4.05+'px');
    }
    $(function() { textSliderCentr(); });
    $(window).resize(function() { textSliderCentr(); });

    function sliderBoxCentr() { /* Центрування центрального боксу слайдера*/
        if ( document.body.clientWidth <= 1440 ){
            $('#sliderCenterBox').css('margin-top', document.body.clientWidth/3/2+'px');
        } else {
            $('#sliderCenterBox').css('margin-top', document.body.clientWidth/4.05-120+'px');
        }
    }
    $(function() { sliderBoxCentr(); });
    $(window).resize(function() { sliderBoxCentr(); });

    function sliderButtonSize() { /* Розмір кнопки на слайдері*/
        if ( document.body.clientWidth <= 1440 ){
            $('.sliderSnake .button a').css('margin-left', (document.body.clientWidth*0.11/2-document.body.clientWidth*0.11)+'px');
            $('.sliderSnake .button a').css('width',document.body.clientWidth*0.12+'px');
            $('.sliderSnake .button a').css('height',document.body.clientWidth/3.2*0.11+'px');
        } else {
            $('.sliderSnake .button a').css('margin-left', '-85px')
            $('.sliderSnake .button a').css('width','180px');
            $('.sliderSnake .button a').css('height','50px');
        }
    }
    $(function() { sliderButtonSize(); });
    $(window).resize(function() { sliderButtonSize(); });

    function centrSliderButtons() { /* центрування кнопок прокрутки слайдеру*/
        if ( document.body.clientWidth <= 1000){
            $('.owl-controls').css('margin-left', '0')
            $('.owl-controls').css('left', '0')
            $('.owl-controls').css('width', 'auto')
        }else {
            $('.owl-controls').css('margin-left', '-538px');
            $('.owl-controls').css('left', '50%')
            $('.owl-controls').css('width', '200px')
        }
    }
    $(function() { centrSliderButtons(); });
    $(window).resize(function() { centrSliderButtons(); });
    function centrMouseLine() { /* Маштабування лінії з мишкою*/
        $('.mouseLine').css('height', document.body.clientWidth/15+'px')
        $('.mouseLine').css('width', document.body.clientWidth+'px')
        $('.mouseLine img').css('height', document.body.clientWidth/15.42+'px')
        $('.mouseLine img').css('width', document.body.clientWidth+'px')
    }
    $(function() { centrMouseLine(); });
    $(window).resize(function() { centrMouseLine(); });
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
        <div class="button">
            <a class="sliderButton" href="#form"><?php echo Yii::t('slider', '0008'); ?></a>
        </div>
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

<?php
$mainpageModel = new Mainpage();
$this->pageTitle = $mainpageModel->getTitle();
$headerText = $mainpageModel->getHeader1();
$subheaderText = $mainpageModel->getSubheader1();
$subLineImage = $mainpage['subLineImage'];
$linkName = $mainpageModel->getLinkName();
$massAbout=array($block1,$block2,$block3);
?>
<div class="mainAboutBlock">
    <div class="mainAbout">
        <div class="header">
            <?php echo $headerText; ?>
            <p>
                <?php echo $subheaderText; ?>
            </p>
        </div>

        <div class="line1">
            <img src="<?php echo $subLineImage;?>">
        </div>

        <?php
        foreach ($massAbout as $val)
        {?>
            <div class="block">
                <ul>
                    <li>
                        <div class="line2">
                            <img src="<?php echo $val->line2Image;?>">
                        </div>
                        <div class="icon">
                            <img src="<?php echo $val->iconImage;?>">
                        </div>
                        <div class="title">
                            <?php echo $val->titleText; ?>
                            <p>
                                <?php echo $val->textAbout;?>
                            </p>
                        </div>
                        <a href="<?php echo $val->linkAddress ?>">
                            <?php echo $linkName; ?>
                        </a>
                    </li>
                </ul>
            </div>
        <?php
        }
        ?>

    </div>
</div>

<?php
$stepHeader =  $mainpageModel->getHeader2();
$stepSubheader =  $mainpageModel->getSubheader2();
$stepSize = $mainpage['stepSize'];
$stepsArray=array($step1,$step2,$step3,$step4,$step5);
?>

<div class="steps" >
    <div class="stepHeaderCont" style="width:<?php echo $stepSize; ?>">
        <div class="stepHeader">
            <h1><?php echo $stepHeader; ?></h1>
            <h3><?php echo $stepSubheader; ?></h3>
        </div>
    </div>
    <?php
    foreach ($stepsArray as $stepValue)
    {
        if ($stepValue->stepNumber % 2 <> 0)
        {
            ?>
            <div class="stepLeft" 	style="width:<?php echo $stepSize; ?>" >
                <div class="stepUrl">
                    <img class="grid" src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/grid.png">
                    <img src="<?php echo $stepValue->stepImage; ?>">
                </div>
                <div class="line">
                </div>

                <img class="hexagon" src="<?php echo $mainpage['hexagon']; ?>">
                <div class="stepArticle">
                    <p class="stepNumber"><?php echo $stepValue->stepNumber; ?></p>
                    <p class="stepName"><?php echo Yii::t('step','step'); ?></p>
                </div>
                <div class="stepInfo" style="min-height:<?php echo $stepSize*0.23 . 'px';?> ">
                    <h2><?php echo $stepValue->stepTitle; ?></h2>
                    <p><?php echo $stepValue->stepText; ?></p>
                </div>
            </div>
        <?php
        }
        else
        {
            ?>
            <div class="stepRight" style="width:<?php echo $stepSize; ?>" >
                <div class="stepUrl">
                    <img class="grid" src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/grid.png">
                    <img src="<?php echo $stepValue->stepImage; ?>">
                </div>
                <div class="line">
                </div>
                <img class="hexagon" src="<?php echo $mainpage['hexagon']; ?>">
                <div class="stepArticle">
                    <p class="stepNumber"><?php echo $stepValue->stepNumber; ?></p>
                    <p class="stepName"><?php echo Yii::t('step','0043'); ?></p>
                </div>
                <div class="stepInfo">
                    <h2><?php echo $stepValue->stepTitle; ?></h2>
                    <p><?php echo $stepValue->stepText; ?></p>
                </div>
            </div>
        <?php
        }
    }
    ?>
</div>
<?php $this->renderPartial('_form'); ?>
</body>
