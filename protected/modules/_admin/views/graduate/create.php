<?php
/* @var $this GraduateController */
/* @var $model Graduate */
?>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/graduate/index');?>">Список випускників</a>

<h1>Додати випускника</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>