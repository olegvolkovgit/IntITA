<body onload="centerPage()">
<?php
/* @var $this SiteController */
?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/sliderMainpage.js"></script>
<?php $this->renderPartial('_slider', array('slider1'=>$slider1,
    'slider2'=>$slider2,
    'slider3'=>$slider3,
    'slider4'=>$slider4,
    'mainpage' => $mainpage)); ?>

<?php
$mainpageModel = new Mainpage();
$this->pageTitle = $mainpageModel->getTitle();
$subLineImage = $mainpage['subLineImage'];
$massAbout=array($block1,$block2,$block3);
?>
<?php $this->renderPartial('_aboutUs', array('massAbout' => $massAbout, 'subLineImage' => $subLineImage, 'mainpageModel' => $mainpageModel));?>

<?php $stepsArray=array($step1,$step2,$step3,$step4,$step5);?>
<?php $this->renderPartial('_steps', array('mainpageModel' => $mainpageModel, 'mainpage' => $mainpage, 'stepsArray' =>$stepsArray)); ?>

<?php if(Yii::app()->user->isGuest) {
    $this->renderPartial('_form');
}
?>
</body>
