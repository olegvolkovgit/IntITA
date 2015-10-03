<?php $this->renderPartial('/site/_shareMetaTag', array(
    'url'=>Yii::app()->createAbsoluteUrl(Yii::app()->request->url),
    'title'=>Yii::t('sharing','0643'),
    'description'=>Yii::t('sharing','0644'),
));
?>
<body>
<script src="http://cdnjs.cloudflare.com/ajax/libs/es5-shim/3.4.0/es5-shim.js"></script>

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
</body>
