<? $css_version = 1; ?>

<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'index.css') ?>"/>

<!-- carousel-plugins -->
<link type="text/css" rel="stylesheet"
      href="<?php echo StaticFilesHelper::fullPathTo('js', 'plugins/owl-carousel/owl.theme.css'); ?>"/>
<link type="text/css" rel="stylesheet"
      href="<?php echo StaticFilesHelper::fullPathTo('js', 'plugins/owl-carousel/owl.carousel.css'); ?>"/>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'plugins/owl-carousel/owl.carousel.js'); ?>"></script>
<!-- carousel-plugins -->
<!-- carousel -->
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'slider.css'); ?>">
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'slider.js'); ?>"></script>
<!-- carousel -->
<script>
    var width = 0;
    if (self.screen) {
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
    document.getElementById('logo').src = logolang;
</script>
<?php $this->renderPartial('_slider', array('slider' => $slider));  ?>

<?php
$mainpage = new Mainpage();
$this->pageTitle = $mainpage->getTitle();
?>

<?php $this->renderPartial('_aboutUs_list', array('aboutUsDataProvider' => $aboutUsDataProvider));?>

<?php $this->renderPartial('_steps_list', array('stepsDataProvider' =>$stepsDataProvider, 'mainpage' => $mainpage)); ?>

<?php if(Yii::app()->user->isGuest) {
    $this->renderPartial('_form', array('mainpage' => $mainpage));
}
?>
<?php
//$this->renderPartial('/site/_shareMetaTagMain', array(
//    'url'=>Yii::app()->createAbsoluteUrl(Yii::app()->request->url),
//    'title'=>Yii::t('sharing','0643'),
//    'description'=>Yii::t('sharing','0644'),
//));

//$this->renderPartial('/site/_shareMetaTagMain', array(
//    'url'=>Yii::app()->createAbsoluteUrl(Yii::app()->request->url),
//    'title'=>Yii::t('sharing','0643'),
//    'description'=>Yii::t('sharing','0644'),
//));
?>
<!--Yii::app()->clientScript->registerMetaTag($url, null, null, array('property' => "og:url"));-->
<!--Yii::app()->clientScript->registerMetaTag($title, null, null, array('property' => "og:title"));-->
<!--Yii::app()->clientScript->registerMetaTag($description, null, null, array('property' => "og:description"));-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.8";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<div class="fb-share-button" data-href="https://qa.intita.com/" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fqa.intita.com%2F&amp;src=sdkpreparse">Поделиться</a></div>


<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'es5-shim.js'); ?>"></script>
