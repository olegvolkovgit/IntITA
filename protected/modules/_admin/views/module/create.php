<?php
/* @var $this ModuleController */
/* @var $model Module */
?>
    <br>
    <br>
    <button type="button" class="btn btn-link">
        <a href="<?php echo Yii::app()->createUrl('/_admin/module/index'); ?>">Всі модулі</a>
    </button>

    <div class="page-header">
        <h1>Створити модуль</h1>
    </div>

<?php $this->renderPartial('_formAddModule', array('model' => $model)); ?>