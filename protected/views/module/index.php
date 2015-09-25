<?php //$this->renderPartial('/site/_shareMetaTag', array(
//    'url'=>Yii::app()->createAbsoluteUrl(Yii::app()->request->url),
//    'title'=>ModuleHelper::getModuleName($post->module_ID),
//    'description'=>'Бажаєте стати висококласним програмістом і гарантовано отримати престижну, високооплачувану роботу? INTITA - те, що ви шукали',
//    'image'=>StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg')));
//?>
<div id="sharing">
    <div class="share42init" data-top1="75" data-top2="110" data-margin="15"
         data-url="<?php echo Yii::app()->createAbsoluteUrl(Yii::app()->request->url) ?>"
         data-title="<?php echo ModuleHelper::getModuleName($post->module_ID);?>"
         data-image="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'); ?>"
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

if($idCourse != 0) {
    $this->breadcrumbs = array(
        Yii::t('breadcrumbs', '0050') => Config::getBaseUrl() . "/courses",
        CourseHelper::getCourseName($idCourse) => Yii::app()->createUrl('course/index', array('id' => $idCourse)), ModuleHelper::getModuleName($post->module_ID),
    );
} else {
    $this->breadcrumbs = array(
        ModuleHelper::getModuleName($post->module_ID),
    );
}
?>

<div class="ModuleBlock">
    <?php $this->renderPartial('_leftModule', array('post' => $post, 'dataProvider' =>$dataProvider, 'editMode' => $editMode, "idCourse"=>$idCourse));?>

    <div class="rightModule">
         <?php $this->renderPartial('_teacherBox', array('teachers' => $teachers));?>
    </div>

</div>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'module.js'); ?>"></script>

