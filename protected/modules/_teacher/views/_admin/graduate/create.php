<?php
/* @var $this GraduateController */
/* @var $model Graduate */
?>
    <br>
    <br>
        <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/graduate/index'); ?>')">Список випускників</a>

    <div class="page-header">
        <h1>Додати випускника</h1>
    </div>
<?php $this->renderPartial('_form', array('model' => $model)); ?>