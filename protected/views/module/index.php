<!-- Module style -->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/module.css" />

<?php
$this->pageTitle = 'INTITA';
$this->breadcrumbs=array(
    Yii::t('breadcrumbs', '0050')=>Yii::app()->request->baseUrl."/courses",CourseHelper::getCourseName($idCourse) =>Yii::app()->createUrl('course/index', array('id' => $idCourse)),$post->module_name,
);
?>

<div class="ModuleBlock">
    <?php $this->renderPartial('_leftModule', array('post' => $post, 'dataProvider' =>$dataProvider, 'editMode' => $editMode, "idCourse"=>$idCourse));?>

    <div class="rightModule">
         <?php $this->renderPartial('_teacherBox', array('teachers' => $teachers));?>
    </div>

</div>


