<?php $this->renderPartial('/site/_shareMetaTag', array(
    'url'=>Yii::app()->createAbsoluteUrl(Yii::app()->request->url),
    'title'=>Module::getModuleName($post->module_ID).'. '.Yii::t('sharing','0643'),
    'description'=>Yii::t('sharing','0644'),
));
?>
<!-- Module style -->
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'module.css'); ?>" />

<?php
$this->pageTitle = 'INTITA';

if($idCourse != 0) {
    $this->breadcrumbs = array(
        Yii::t('breadcrumbs', '0050') => Config::getBaseUrl() . "/courses",
        Course::getCourseName($idCourse) => Yii::app()->createUrl('course/index', array('id' => $idCourse)), Module::getModuleName($post->module_ID),
    );
} else {
    $this->breadcrumbs = array(
        Module::getModuleName($post->module_ID),
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
<?php if ($editMode) { ?>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'titleValidation.js'); ?>"></script>
<?php } ?>

