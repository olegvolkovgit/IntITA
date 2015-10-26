<?php $this->renderPartial('/site/_shareMetaTag', array(
    'url'=>Yii::app()->createAbsoluteUrl(Yii::app()->request->url),
    'title'=>Yii::t('sharing','0643'),
    'description'=>Yii::t('sharing','0644'),
));
?>
<link rel="stylesheet" type="text/css" href="<?php echo Config::getBaseUrl(); ?>/css/aboutusstyles.css"/>
<link type="text/css" rel="stylesheet" href="<?php echo Config::getBaseUrl(); ?>/css/step.css"/>
<script src="http://cdnjs.cloudflare.com/ajax/libs/es5-shim/3.4.0/es5-shim.js"></script>
<!-- carousel-plugins -->
<link type="text/css" rel="stylesheet"
      href="<?php echo Config::getBaseUrl(); ?>/scripts/plugins/owl-carousel/owl.theme.css"/>
<link type="text/css" rel="stylesheet"
      href="<?php echo Config::getBaseUrl(); ?>/scripts/plugins/owl-carousel/owl.carousel.css"/>
<script src="<?php echo Config::getBaseUrl(); ?>/scripts/plugins/owl-carousel/owl.carousel.js"></script>
<!-- carousel-plugins -->
<!-- carousel -->
<link type="text/css" rel="stylesheet" href="<?php echo Config::getBaseUrl(); ?>/css/slider.css">
<script src="<?php echo Config::getBaseUrl(); ?>/scripts/slider.js"></script>
<!-- carousel -->

<?php $this->renderPartial('_slider', array('slider' => $slider));  ?>

<?php
$this->pageTitle = MainpageHelper::getTitle();
?>

<?php $this->renderPartial('_aboutUs_list', array('aboutUsDataProvider' => $aboutUsDataProvider));?>

<?php $this->renderPartial('_steps_list', array('stepsDataProvider' =>$stepsDataProvider)); ?>

<?php if(Yii::app()->user->isGuest) {
    $this->renderPartial('_form');
}
?>
