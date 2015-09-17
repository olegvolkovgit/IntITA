<?php
Yii::app()->clientScript->registerMetaTag(Yii::app()->createAbsoluteUrl(Yii::app()->request->url), null, null, array('property' => "og:url"));
Yii::app()->clientScript->registerMetaTag(ModuleHelper::getModuleName($post->module_ID), null, null, array('property' => "og:title"));
Yii::app()->clientScript->registerMetaTag("Бажаєте стати висококласним програмістом і гарантовано отримати престижну, високооплачувану роботу? INTITA - те, що ви шукали", null, null, array('property' => "og:description"));
Yii::app()->clientScript->registerMetaTag(StaticFilesHelper::createPath('image', 'module/share', ImageHelper::setOpenGraphImage(Yii::getPathOfAlias('webroot')."/images/module/share/",'shareModuleImg_',$post->module_ID,'defaultModuleImg.png')), null, null, array('itemprop' => "image"));
Yii::app()->clientScript->registerMetaTag(StaticFilesHelper::createPath('image', 'module/share', ImageHelper::setOpenGraphImage(Yii::getPathOfAlias('webroot')."/images/module/share/",'shareModuleImg_',$post->module_ID,'defaultModuleImg.png')), null, null, array('property' => "og:image"));
Yii::app()->clientScript->registerMetaTag(StaticFilesHelper::createPath('image', 'module/share', ImageHelper::setOpenGraphImage(Yii::getPathOfAlias('webroot')."/images/module/share/",'shareModuleImg_',$post->module_ID,'defaultModuleImg.png')), null, null, array('itemprop' => "image"));
?>
<div id="sharing">
    <div class="share42init" data-top1="75" data-top2="110" data-margin="15"
         data-url="<?php echo Yii::app()->createAbsoluteUrl(Yii::app()->request->url) ?>"
         data-title="<?php echo ModuleHelper::getModuleName($post->module_ID);?>"
         data-image="<?php echo StaticFilesHelper::createPath('image', 'module/share', ImageHelper::setOpenGraphImage(Yii::getPathOfAlias('webroot')."/images/module/share/",'shareModuleImg_',$post->module_ID,'defaultModuleImg.png'));?>"
         data-description="Бажаєте стати висококласним програмістом і гарантовано отримати престижну, високооплачувану роботу? INTITA - те, що ви шукали"
         data-path="<?php echo Config::getBaseUrl(); ?>/scripts/share42/"
         data-zero-counter="1">
    </div>
</div>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'share42/share42.js'); ?>"></script>
<!-- Module style -->
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'module.css'); ?>" />

<?php
$this->pageTitle = 'INTITA';
$this->breadcrumbs=array(
    Yii::t('breadcrumbs', '0050')=>Config::getBaseUrl()."/courses",CourseHelper::getCourseName($idCourse) =>Yii::app()->createUrl('course/index', array('id' => $idCourse)),ModuleHelper::getModuleName($post->module_ID),
);
?>

<div class="ModuleBlock">
    <?php $this->renderPartial('_leftModule', array('post' => $post, 'dataProvider' =>$dataProvider, 'editMode' => $editMode, "idCourse"=>$idCourse));?>

    <div class="rightModule">
         <?php $this->renderPartial('_teacherBox', array('teachers' => $teachers));?>
    </div>

</div>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'module.js'); ?>"></script>

