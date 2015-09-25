<?php $this->renderPartial('/site/_shareMetaTag', array(
    'url'=>Yii::app()->createAbsoluteUrl(Yii::app()->request->url),
    'title'=>$model->first_name." ".$model->last_name,
    'description'=>'Бажаєте стати висококласним програмістом і гарантовано отримати престижну, високооплачувану роботу? INTITA - те, що ви шукали',
));
?>
<!--data-url="--><?php //echo Yii::app()->createAbsoluteUrl(Yii::app()->request->url) ?><!--"-->
<!--data-title="--><?php //echo $model->first_name." ".$model->last_name;?><!--"-->
<!--data-image="--><?php //echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'); ?><!--"-->
<!--data-description="Бажаєте стати висококласним програмістом і гарантовано отримати престижну, високооплачувану роботу? INTITA - те, що ви шукали"-->
<div id="sharing">
    <div class="share42init" data-top1="75" data-top2="110" data-margin="15"
         data-path="<?php echo Config::getBaseUrl(); ?>/scripts/share42/"
         data-zero-counter="1">
    </div>
</div>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'share42/share42.js'); ?>"></script>
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

<script type="text/javascript" charset="utf-8" src="<?php echo StaticFilesHelper::fullPathTo('js', 'rating/js/jquery.raty.js'); ?>"></script>

<div class="TeacherProfilemainBlock">
    <?php $this->renderPartial('_profileBlock1', array('model' => $model, 'editMode' => $editMode)); ?>
    <!-- Block 2 -->
    <?php $this->renderPartial('_profileBlock2', array('model' => $model, 'editMode' => $editMode, 'dataProvider' => $dataProvider,'response' => $response)); ?>
</div>

    <!--<!-- Підключення BBCode WysiBB -->
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'wysibb/jquery.wysibb.min.js'); ?>"></script>
    <link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('js', 'wysibb/theme/default/wbbtheme.css'); ?>"
          type="text/css" />
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'wysibb/lang/ua.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js',  'wysibb/BBCode.js'); ?>"></script>
    <!-- Підключення BBCode WysiBB -->
    <!-- Spoiler -->
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'SpoilerContent.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'teacherProfile.js'); ?>"></script>
    <!-- teacherProfile style -->
    <link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'teacherProfile.css'); ?>" />
    <!-- steps style -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css">
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'loadRedactorProfile.js'); ?>"></script>
