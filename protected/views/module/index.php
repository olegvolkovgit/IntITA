<? $css_version = 1; ?>
<?php
/**
 * @var $post Module
 */
?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'module.css'); ?>" />
<?php
if($idCourse != 0) {
    $this->breadcrumbs = array(
        Yii::t('breadcrumbs', '0050') => Config::getBaseUrl() . "/courses",
        Course::getCourseTitleForBreadcrumbs($idCourse) => Yii::app()->createUrl('course/index', array('id' => $idCourse)),
        $post->getTitleForBreadcrumbs(),
    );
} else {
    $this->breadcrumbs = array(
        $post->getTitleForBreadcrumbs(),
    );
}
?>

<div class="ModuleBlock">
    <?php $this->renderPartial('_leftModule', array('post' => $post, 'dataProvider' =>$dataProvider, 'editMode' => $editMode, "idCourse"=>$idCourse,"isPaidCourse"=>$isPaidCourse,"isPaidModule"=>$isPaidModule,'isReadyCourse' => $isReadyCourse));?>

    <div class="rightModule">
         <?php $this->renderPartial('_teacherBox', array('teachers' => $teachers));?>
    </div>

</div>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'module.js'); ?>"></script>
<?php
$this->renderPartial('/site/_shareMetaTag', array(
    'url'=>Yii::app()->createAbsoluteUrl(Yii::app()->request->url),
    'title'=>$post->getTitle().'. '.Yii::t('sharing','0643'),
    'description'=>Yii::t('sharing','0644'),
));
?>
<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/jquery.cookie.js"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/bootbox.min.js'); ?>"></script>
<link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bootstrapRewrite.css') ?>"/>

