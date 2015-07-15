<?php
/* @var $this CoursemanageController */
/* @var $model Course */

$this->breadcrumbs=array(
    Yii::t("coursemanage", "0508")=>array('index'),
	$model->course_ID=>array('view','id'=>$model->course_ID),
    Yii::t("coursemanage", "0514"),
);

$this->menu=array(
	array('label'=>Yii::t("coursemanage", "0510"), 'url'=>array('index')),
	array('label'=>Yii::t("coursemanage", "0511"), 'url'=>array('create')),
	array('label'=>Yii::t("coursemanage", "0523"), 'url'=>array('view', 'id'=>$model->course_ID)),
	array('label'=>Yii::t("coursemanage", "0512"), 'url'=>array('admin')),
);
?>

<h1>Оновити курс <?php echo $model->course_ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>