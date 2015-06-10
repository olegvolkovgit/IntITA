<!-- lesson style -->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lessonsStyle.css" />

<!--<script type="text/javascript" charset="utf-8" src="--><?php //echo Yii::app()->request->baseUrl; ?><!--/scripts/rating/js/jquery.min.js"></script>-->
<script type="text/javascript" charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/rating/js/jquery.raty.js"></script>
<!--<!-- Підключення BBCode WysiBB -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/wysibb/jquery.wysibb.min.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/scripts/wysibb/theme/default/wbbtheme.css" type="text/css" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/wysibb/lang/ua.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/wysibb/BBCode.js"></script>
<!-- Підключення BBCode WysiBB -->
<!-- Spoiler -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/SpoilerContent.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/teacherProfile.js"></script>
<!-- teacherProfile style -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/teacherProfile.css" />
<!-- steps style -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css">
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/loadRedactor.js"></script>

<?php
/* @var $this ProfileController */
$this->pageTitle = 'INTITA';
$this->breadcrumbs=array(Yii::t('breadcrumbs', '0052')=>Yii::app()->createUrl('teachers'), Yii::t('breadcrumbs', '0057'));

$tmp2 = Yii::t('teachers', '0061');
if (isset($_GET['div'])){
    $currentDiv = $_GET['div'];
} else {
    $currentDiv = '';
}
?>
<div class="TeacherProfilemainBlock">
    <?php $this->renderPartial('_profileBlock1', array('model' => $model, 'sections' => $sections, 'editMode' => $editMode)); ?>
    <!-- Block 2 -->
    <?php $this->renderPartial('_profileBlock2', array('model' => $model, 'editMode' => $editMode, 'dataProvider' => $dataProvider)); ?>

