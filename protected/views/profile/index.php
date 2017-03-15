<? $css_version = 1; ?>
    <!-- teacherProfile style -->
    <link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'teacherProfile.css'); ?>" />
    <link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bootstrapRewrite.css') ?>"/>
<?php
/* @var $this ProfileController */
/* @var $model Teacher */
/* @var $response Response */
$this->breadcrumbs=array(Yii::t('breadcrumbs', '0052')=>Yii::app()->createUrl('teachers'), Yii::t('breadcrumbs', '0057'));

$tmp2 = Yii::t('teachers', '0061');
if (isset($_GET['div'])){
    $currentDiv = $_GET['div'];
} else {
    $currentDiv = '';
}
?>

<script type="text/javascript" charset="utf-8" src="<?php echo StaticFilesHelper::fullPathTo('js', 'rating/js/jquery.raty.js'); ?>"></script>

<div class="TeacherProfilemainBlock">
    <?php $this->renderPartial('_profileBlock1', array('model' => $model, 'editMode' => $editMode)); ?>
    <!-- Block 2 -->
    <?php $this->renderPartial('_profileBlock2', array('model' => $model, 'editMode' => $editMode, 'dataProvider' => $dataProvider,'response' => $response)); ?>
</div>
    <script src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/bootbox.min.js'); ?>"></script>
    <!--<!-- Підключення BBCode WysiBB -->
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'wysibb/jquery.wysibb.min.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('js', 'wysibb/theme/default/wbbtheme.css'); ?>"
          type="text/css" />
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'wysibb/lang/ua.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js',  'wysibb/BBCode.js'); ?>"></script>
    <!-- Підключення BBCode WysiBB -->
    <!-- Spoiler -->
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'teacherProfile.js'); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'font-awesome.min.css'); ?>" />
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'loadRedactorProfile.js'); ?>"></script>
    <!-- Підключення Bootsrtap-tooltip -->
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'bootstrap-datetimepicker/bootstrap/js/tooltip.js'); ?>"></script>
<?php
$this->renderPartial('/site/_shareMetaTag', array(
    'url'=>Yii::app()->createAbsoluteUrl(Yii::app()->request->url),
    'title'=>$model->firstName()." ".$model->lastName().'. '.Yii::t('sharing','0643'),
    'description'=>Yii::t('sharing','0644'),
));
?>