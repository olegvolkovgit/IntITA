<?php
/* @var $this GraduateController */
/* @var $model Graduate */
?>
    <br>
    <a href="<?php echo Yii::app()->config->get('baseUrl');?>/_admin/graduate/index">Список випускників</a>
    <br>
    <a href="<?php echo Yii::app()->config->get('baseUrl');?>/_admin/graduate/admin">Управління випускниками</a>

<h1>Create Graduate</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>