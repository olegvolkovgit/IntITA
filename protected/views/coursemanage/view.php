<?php
/* @var $this CoursemanageController */
/* @var $model Course */

$this->breadcrumbs=array(
    Yii::t("coursemanage", "0508")=>array('index'),
	$model->course_ID,
);

$this->menu=array(
	array('label'=>Yii::t("coursemanage", "0510"), 'url'=>array('index')),
	array('label'=>Yii::t("coursemanage", "0511"), 'url'=>array('create')),
	array('label'=>Yii::t("coursemanage", "0524"), 'url'=>array('update', 'id'=>$model->course_ID)),
	array('label'=>Yii::t("coursemanage", "0525"), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->course_ID),'confirm'=>Yii::t("coursemanage", "0518"))),
	array('label'=>Yii::t("coursemanage", "0512"), 'url'=>array('admin')),
);
?>

<h1>Курс <?php echo $model->course_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'course_ID',
		'language',
		'course_name',
		'level',
		'start',
		'status',
		'course_price',
		'for_whom',
		'what_you_learn',
		'what_you_get',
		'course_img',
	),
)); ?>
