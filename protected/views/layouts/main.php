<?php /* @var $this Controller */
$header = new Header();?>
<!DOCTYPE html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="en">

    <!-- for tabs -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- for tabs -->

    <!-- fonts -->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/fontface.css"/>
    <!-- fonts -->
    <!-- layouts style -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
    <!--   hamburger menu style -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/hamburgerMenu.css" />
    <!-- aboutUs style -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/aboutusstyles.css" />
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/step.css" />
    <!-- steps style -->
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/css/images/favicon.ico" type="image/x-icon"/>
    <!-- jQuery -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <!-- jQuery -->
    <!-- carousel-plugins -->
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/scripts/plugins/owl-carousel/owl.theme.css"/>
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/scripts/plugins/owl-carousel/owl.carousel.css"/>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/plugins/owl-carousel/owl.carousel.js"></script>
    <!-- carousel-plugins -->
    <!-- carousel -->
    <link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/slider.css">
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/slider.js"></script>
    <!-- carousel -->
    <!-- passEye, jQuery -->
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/jquery.passEye.js"></script>
    <!-- passEye, jQuery -->

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div id="navigation" class="down" >
    <div class="main">
        <div id="logo_img" class="down">
            <a href="<?php echo Yii::app()->request->baseUrl;?>">
                <img id="logo" src="<?php echo Yii::app()->request->baseUrl;?>/css/images/Logo_small.png"/>
            </a>
        </div>
        <ul>
            <li><a href="<?php echo $this->link1; ?>"><?php echo Yii::t('header','0016'); ?></a></li>
            <li><a href="<?php echo $this->link2; ?>"><?php echo Yii::t('header','0021'); ?></a></li>
            <li><a href="<?php echo $this->link3; ?>"><?php echo Yii::t('header','0137'); ?></a></li>
            <li><a href="<?php echo $this->link3; ?>"><?php echo Yii::t('header','0017'); ?></a></li>
            <li><a href="<?php echo $this->link4; ?>"><?php echo Yii::t('header','0018'); ?></a></li>
        </ul>
    </div>

    <div id="lang" class="down">
        <form  method="" onsubmit="" name="fff">
            <?php echo CHtml::button('ua', array('submit' => array('site/changeLang','lg'=>'ua'),'id'=>"ua",'name'=>"ua")); ?>
            <?php echo CHtml::button('en', array('submit' => array('site/changeLang','lg'=>'en'),'id'=>"en",'name'=>"en")); ?>
            <?php echo CHtml::button('ru', array('submit' => array('site/changeLang','lg'=>'ru'),'id'=>"ru",'name'=>"ru")); ?>
        </form>
    </div>
    <?php
    $app = Yii::app();
    switch ($app->session['lg']) {
    case 'ua':
        ?>
        <script>
            document.getElementById('ua').disabled = true;
            document.getElementById('ua').className = "selectedLang";
        </script>
    <?php
    break;
    case 'en':
    ?>
        <script>
            document.getElementById('en').disabled = true;
            document.getElementById('en').className = "selectedLang";
        </script>
    <?php
    break;
    case 'ru':
    ?>
        <script>
            document.getElementById('ru').disabled = true;
            document.getElementById('ru').className = "selectedLang";
        </script>
        <?php
        break;
    }
    ?>
</div>

<div id="centerEnterButton">
    <div id="button_border" class="down">
    </div>
    <?php if(Yii::app()->user->isGuest) {
        echo CHtml::link($header->getEnterButton(), '#', array('id'=>'enter_button','class'=>'down','onclick' => '$("#mydialog").dialog("open"); return false;',));
    } else {?>
        <a id="enter_button" href="<?php echo Yii::app()->request->getBaseUrl(true); ?>/site/logout" class="down"><?php echo $header->getLogoutButton(); ?></a>
    <?php }?>
</div>



<! Hamburger menu>

<div id="hamburgerNavigation">
    <div id="hamburgerSenterNavigation">
        <div id="burgerShadow">
        </div>
        <div id="hamburgerButton2" onclick="ShowHamburger()">
            <ul>
                <li><div class="hamburgerButtonLine2"></div></li>
                <li><div class="hamburgerButtonLine2"></div></li>
                <li><div class="hamburgerButtonLine2"></div></li>
            </ul>
        </div>
        <div id="logo2" class="down">
            <a href="<?php echo Yii::app()->request->baseUrl;?>">
                <img  src="<?php echo Yii::app()->request->baseUrl;?>/css/images/Logo_small.png"/>
            </a>
        </div>
        <div id="hamburgerLang">
            <form action="" method="post" onsubmit="" name="fff">
                <button formaction="<?php echo Yii::app()->createUrl('site/changeLang', array('lg'=>'ua'));?>" id="ua" name="ua" onclick="changeLang(this)" class="selectedLang" disabled>ua</button>
                <button formaction="<?php echo Yii::app()->createUrl('site/changeLang', array('lg'=>'en'));?>" id="en" name="en" onclick="changeLang(this)">en</button>
                <button formaction="<?php echo Yii::app()->createUrl('site/changeLang', array('lg'=>'ru'));?>" id="ru" name="ru" onclick="changeLang(this)">ru</button>
            </form>
        </div>
    </div>
</div>

<div id="hamburgerMainBox">
    <div id="hamburgerSubBox">
        <div class="hamburgerBox">
            <a class="hamburgerLink" href="<?php echo $this->link1; ?>"><?php echo Yii::t('header','0016'); ?></a>
        </div>
        <div class="hamburgerLine"></div>
        <div class="hamburgerBox">
            <a  class="hamburgerLink" href="<?php echo $this->link2; ?>"><?php echo Yii::t('header','0021'); ?></a>
        </div>
        <div class="hamburgerLine"></div>
        <div class="hamburgerBox">
            <a  class="hamburgerLink" href="<?php echo $this->link3; ?>"><?php echo Yii::t('header','0017'); ?></a>
        </div>
        <div class="hamburgerLine"></div>
        <div class="hamburgerBox">
            <a  class="hamburgerLink" href="<?php echo $this->link4; ?>"><?php echo Yii::t('header','0018'); ?></a>
        </div>
        <div class="hamburgerLine"></div>
        <div class="hamburgerBox2">
            <a id="hamburgerEnterButton" href="<?php echo Yii::app()->request->baseUrl;?>#form"><?php echo $header->getEnterButton(); ?></a>
        </div>
    </div>
</div>


<script>
    var width=0;
    if (self.screen)
    {
        width = screen.width
    }
    if (width>80)
    {
        $('#hamburgerNavigation').css('display', 'none');
        $('#contentBoxMain').css('margin-top', '-1000px');
        $('#navigation').css('display', 'block');
        $('#centerEnterButton').css('display', 'block');
        var key = document.getElementById('enter_button');
        var nav = document.getElementById('navigation');
        var logo = document.getElementById('logo_img');
        var border = document.getElementById('button_border');
    }
    else
    {
        var  isShow=0;
        $('#hamburgerNavigation').css('display', 'inline-block');
        $('#navigation').css('display', 'none');
        $('#centerEnterButton').css('display', 'none');
        $('body').css('margin-top', '-23px');
        $('#hamburgerSenterNavigation').css('width', width);
        $('#hamburgerSenterNavigation').css('margin-left', -(width/2));
        $('#hamburgerLang').css('left', width-130);
        function ShowHamburger()
        {
            if (isShow==0)
            {
                isShow=1;
                $('#hamburgerButton').css('display','none');
                $('.hamburgerButtonLine2').css('background-color',' #535353');
                $('#contentBoxMain').animate({left:'+=25%'},'fast');
                $('#hamburgerNavigation').animate({left:'+=25%'},'fast');
                $('#hamburgerMainBox').fadeIn('middle');
                $('#hamburgerLang').animate({left:'-=0px'},'fast');
            }
            else
            {
                isShow=0;
                $('#hamburgerButton').css('display','block');
                $('.hamburgerButtonLine2').css('background-color','#4682B4');
                $('#hamburgerMainBox').css('display','none');
                $('#contentBoxMain').animate({left:'-=25%'});
                $('#hamburgerNavigation').animate({left:'-=25%'});
                $('#contentBoxMain').css('margin-left', '0%');
                $('#hamburgerLang').animate({left:'+=0px'});
            }
        }
    }
</script>

<div class="clear"></div>


<div class="main">

    <div style="height: 55px; width: auto"></div>

    <?php if(isset($this->breadcrumbs)):?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
            'homeLink'=>CHtml::link(Yii::t('breadcrumbs', '0049'),Yii::app()->request->getBaseUrl(true)),
            'htmlOptions' => array(
                'class' => 'my-cool-breadcrumbs'
            )
        )); ?><!-- breadcrumbs -->
    <?php endif?>

    <?php if(!Yii::app()->user->isGuest) {
        $post=StudentReg::model()->findByPk(Yii::app()->user->id);
        ?>
        <div class="profileStatus">
            <a href="<?php echo Yii::app()->request->baseUrl.'/studentreg/profile'; ?>">
                <div>
                    <?php echo $post->firstName;?></br>
                    <?php echo $post->secondName;?></br>
                    <?php echo $post->nickname;?></br>
                    <span style="color: #33cc00; font-size: smaller">&#x25A0; online</span>
                </div>
                <img src="<?php echo Yii::app()->request->baseUrl.$post->avatar; ?>"/>
            </a>
        </div>
    <?php
    }
    ?>
</div>
<div id="contentBoxMain">
    <?php echo $content; ?>



    <div class="clear"></div>




    <?php $footer = new Footer();?>
    <div id="footer">
        <div class="main" >
            <div id="footer1">

                <table><tr><td style="padding: 0px;" >


                <a href="https://twitter.com/INTITA_EDU">
                    <img style="margin-top: 10px" src="<?php echo Yii::app()->request->baseUrl;?>/css/images/twitter.png"/></a>
                <a href="http://youtube.com">
                    <img src="<?php echo Yii::app()->request->baseUrl;?>/css/images/youtube.png"/></a>
                <a href="https://plus.google.com/u/0/116490432477798418410/posts">
                    <img src="<?php echo Yii::app()->request->baseUrl;?>/css/images/googlePlus.png"/><br/></a>
                        </td></tr>
                   <tr> <td>
                 <a href="https://www.facebook.com/pages/INTITA/320360351410183">
                    <img src="<?php echo Yii::app()->request->baseUrl;?>/css/images/facebook.png"/></a>
                <a href="https://www.linkedin.com/company/intita?trk=biz-companies-cym">
                    <img src="<?php echo Yii::app()->request->baseUrl;?>/css/images/inl.png"/></a>
                <a href="http://vk.com/intita">
                    <img src="<?php echo Yii::app()->request->baseUrl;?>/css/images/vkontakte.png"/></a>


                       </td>
                   </tr></table>

            </div>
            <div id="footer2">
                <div>
                    <a href="<?php echo Yii::app()->request->baseUrl;?>">
                        <img src="<?php echo Yii::app()->request->baseUrl;?>/css/images/Logo_small.png" style="max-width: 140px; padding-left: 0px;">
                    </a>
                </div>
                <div style="margin-left: 0px; padding-bottom: -10px;">
                    <p > <?php echo $footer->getTel();  ?><br/>
                        <?php echo $footer->getMobile();  ?><br/>
                        <?php echo $footer->getEmail(); ?><br/>
                        <?php echo $footer->getSkype(); ?><br/>
                    </p>
                </div>
                <div>
                    <ul>
                        <li><a href="<?php echo $this->link1; ?>"><?php echo Yii::t('header','0016'); ?></a></li>
                        <li><a href="<?php echo $this->link2; ?>"><?php echo Yii::t('header','0021');  ?></a></li>
                        <li><a href="<?php echo $this->link2; ?>"><?php echo Yii::t('header','0137');  ?></a></li>
                        <li><a href="<?php echo $this->link3; ?>"><?php echo Yii::t('header','0017');  ?></a></li>
                        <li><a href="<?php echo $this->link4; ?>"><?php echo Yii::t('header','0018');  ?></a></li>
                    </ul>
                </div>
            </div>
            <div id="footer3">
                <a href="#"><img src="<?php echo $this->imageUp; ?>" ></a>
            </div>
            <div id="footer4"></div>





            <!--SingIn modal-->
            <?php
            $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                'id' => 'mydialog',
                'themeUrl'=>Yii::app()->request->baseUrl.'/css',
                'cssFile'=>'jquery-ui.css',
                'theme'=>'my',
                'options' => array(
                    'width'=>540,
                    'autoOpen' => false,
                    'modal' => true,
                    'resizable'=> false
                ),
            ));
            $this->renderPartial('/site/_signinform');
            $this->endWidget('zii.widgets.jui.CJuiDialog');
            ?>
            <!--SignIn modal-->
        </div>
    </div><!-- footer -->
</div>
</body>
</html>