<?php $this->renderPartial('/site/_shareMetaTag', array(
    'url'=>Yii::app()->createAbsoluteUrl(Yii::app()->request->url),
    'title'=>'INTITA-ПРОГРАМУЙ МАЙБУТНЄ!',
    'description'=>'Бажаєте стати висококласним програмістом і гарантовано отримати престижну, високооплачувану роботу? INTITA - те, що ви шукали',
));
?>
<body>
<!--data-url="--><?php //echo Yii::app()->createAbsoluteUrl(Yii::app()->request->url) ?><!--"-->
<!--data-title="INTITA-ПРОГРАМУЙ МАЙБУТНЄ!"-->
<!--data-image="--><?php //echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'); ?><!--"-->
<!--data-description="Бажаєте стати висококласним програмістом і гарантовано отримати престижну, високооплачувану роботу? INTITA - те, що ви шукали"-->
<div id="sharing">
    <div class="share42init" data-top1="75" data-top2="110" data-margin="15"
         data-path="<?php echo Config::getBaseUrl(); ?>/scripts/share42/"
         data-zero-counter="1">
    </div>
</div>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'share42/share42.js');?>"></script>
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
