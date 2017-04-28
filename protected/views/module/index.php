<? $css_version = 1; ?>
<?php
/**
 * @var $post Module
 * @var $teachers 
 */
?>
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('zii.widgets.assets')).'/gridview/styles.css' ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'schemes.css'); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'module.css'); ?>" />
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/main_app/controllers/moduleCtrl.js'); ?>"></script>
<script>
    basePath = '<?php echo Config::getBaseUrl(); ?>';
    idModule = '<?php echo $post->module_ID;?>';
    idCourse = '<?php echo $idCourse ?>';
    finishedPrevLectureMsg='<?php echo Yii::t('exception', '0870') ?>';
</script>
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

<div class="ModuleBlock" ng-controller="moduleCtrl" ng-cloak ng-hide="!moduleProgress">
    <?php $this->renderPartial('_leftModule', array('post' => $post, "idCourse"=>$idCourse));?>

    <div class="rightModule">
         <?php $this->renderPartial('_teacherBox', array('teachers' => $teachers,'idModule'=>$post->module_ID));?>
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
<script src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/bootbox.min.js'); ?>"></script>
<link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bootstrapRewrite.css') ?>"/>

