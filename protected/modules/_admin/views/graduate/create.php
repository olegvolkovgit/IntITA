<?php
/* @var $this GraduateController */
/* @var $model Graduate */
?>
    <br>
    <br>
    <button type="button" class="btn btn-link">
        <a href="<?php echo Yii::app()->createUrl('/_admin/graduate/index');?>">Список випускників</a>
    </button>

    <div class="page-header">
        <h1>Додати випускника</h1>
    </div>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>