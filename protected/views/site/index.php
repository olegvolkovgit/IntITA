<? $css_version = 1; ?>

<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'aboutusstyles.css'); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'step.css'); ?>"/>

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
$this->renderPartial('/site/_shareMetaTag', array(
    'url'=>Yii::app()->createAbsoluteUrl(Yii::app()->request->url),
    'title'=>Yii::t('sharing','0643'),
    'description'=>Yii::t('sharing','0644'),
));
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/es5-shim/3.4.0/es5-shim.js"></script>
