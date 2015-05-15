<body onload="centerPage()">
<?php
/* @var $this SiteController */
?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/sliderMainpage.js"></script>
<?php $this->renderPartial('_slider');  ?>

<?php
$mainpageModel = new Mainpage();
$this->pageTitle = $mainpageModel->getTitle();
$subLineImage = StaticFilesHelper::createPath('image', 'mainpage', 'line1.png');
$massAbout=array($block1,$block2,$block3);
?>
<?php $this->renderPartial('_aboutUs', array('massAbout' => $massAbout, 'subLineImage' => $subLineImage));?>

<?php $stepsArray=array($step1,$step2,$step3,$step4,$step5);?>
<?php $this->renderPartial('_steps', array('mainpageModel' => $mainpageModel, 'mainpage' => $mainpage, 'stepsArray' =>$stepsArray)); ?>

<?php $this->renderPartial('_form'); ?>
</body>
