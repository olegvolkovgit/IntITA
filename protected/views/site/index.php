<?php
/* @var $this SiteController */
Yii::app()->clientScript->registerMetaTag(Yii::app()->createAbsoluteUrl(Yii::app()->request->url), null, null, array('property' => "og:url"));
Yii::app()->clientScript->registerMetaTag('INTITA-ПРОГРАМУЙ МАЙБУТНЄ!', null, null, array('property' => "og:title"));
Yii::app()->clientScript->registerMetaTag("Бажаєте стати висококласним програмістом і гарантовано отримати престижну, високооплачувану роботу? INTITA - те, що ви шукали", null, null, array('property' => "og:description"));
Yii::app()->clientScript->registerMetaTag(StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'), null, null, array('property' => "og:image"));
?>
<body>
<div id="sharing">
    <div class="share42init" data-top1="75" data-top2="110" data-margin="15"
         data-url="<?php echo Yii::app()->createAbsoluteUrl(Yii::app()->request->url) ?>"
         data-title="INTITA-ПРОГРАМУЙ МАЙБУТНЄ!"
         data-image="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'); ?>"
         data-description="Бажаєте стати висококласним програмістом і гарантовано отримати престижну, високооплачувану роботу? INTITA - те, що ви шукали"
         data-path="<?php echo Yii::app()->request->baseUrl; ?>/scripts/share42/"
         data-zero-counter="1">
    </div>
</div>
<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/share42/share42.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/es5-shim/3.4.0/es5-shim.js"></script>

<?php $this->renderPartial('_slider', array('slider' => $slider));  ?>

<?php
$this->pageTitle = MainpageHelper::getTitle();
$massAbout=array($block1,$block2,$block3);
?>
<?php $this->renderPartial('_aboutUs', array('massAbout' => $massAbout));?>

<?php $stepsArray=array($step1,$step2,$step3,$step4,$step5);?>
<?php $this->renderPartial('_steps', array('stepsArray' =>$stepsArray)); ?>

<?php if(Yii::app()->user->isGuest) {
    $this->renderPartial('_form');
}
?>
</body>
