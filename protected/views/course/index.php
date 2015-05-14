<!-- course style -->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/course.css" />
<!-- course style -->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/module.css" />
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/readmore/readmore.js"></script>
<!-- BD -))) -->
<?php
$this->pageTitle = 'INTITA';
$this->breadcrumbs=array(
    Yii::t('breadcrumbs', '0050')=>Yii::app()->request->baseUrl."/courses",$model->course_name,
);
?>

<div class="courseBlock">
    <div class="courseTitle">
        <h1><?php //echo $model->course_name?>
            <?php
            $this->widget('editable.Editable', array(
                'type'      => 'text',
                'name'      => 'course_name',
                'text'      => $model->course_name,
                'url'       => $this->createUrl('course/updateCourse'),
                'title'     => 'Введіть назву курса',
                'placement' => 'right'
            ));
            ?>
        </h1>
    </div>
    <div class="courseShortInfo">
        <?php $this->renderPartial('_courseShortInfo', array('model'=>$model));?>
        <?php $this->renderPartial('_courseInfo', array('model'=>$model));?>

        <div class="courseTeachers">
            <h2><?php echo Yii::t('course', '0207'); ?></h2>
            <article>
                <?php $this->renderPartial('_courseTeacher', array('course'=>$model));?>
            </article>
        </div>
        <?php echo $this->renderPartial('_modulesList', array('dataProvider' => $dataProvider, 'canEdit' =>$canEdit, 'model'=>$model));?>
</div>
</div>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/spoilerPrice.js"></script>

