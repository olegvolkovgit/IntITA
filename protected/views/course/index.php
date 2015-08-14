<!-- course style -->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/course.css" />
<!-- course style -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/spoilerPay.js"></script>
<!-- BD -))) -->
<?php
$this->pageTitle = 'INTITA';
$this->breadcrumbs=array(
    Yii::t('breadcrumbs', '0050')=>Yii::app()->request->baseUrl."/courses",CourseHelper::getCourseName($model->course_ID),
);

?>

<div class="courseBlock">
    <div class="courseTitle">
        <h1>
            <?php echo CourseHelper::getCourseName($model->course_ID);?>
        </h1>
    </div>
    <div class="courseShortInfo">
        <?php $this->renderPartial('_courseShortInfo', array('model'=>$model));?>
        <br>

        <div class="courseTeachers">
            <?php $this->renderPartial('_courseInfo', array('model'=>$model));?>
        </div>
        <?php echo $this->renderPartial('_modulesList', array('dataProvider' => $dataProvider, 'canEdit' =>$canEdit, 'model'=>$model));?>
    </div>
</div>

