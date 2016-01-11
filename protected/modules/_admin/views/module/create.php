<?php
/* @var $this ModuleController */
/* @var $model Module */
?>
    <br>
    <br>
        <a href="<?php echo Yii::app()->createUrl('/_admin/module/index'); ?>">Всі модулі</a>

    <div class="page-header">
        <h1>Створити модуль</h1>
    </div>

<?php $this->renderPartial('_formAddModule', array('model' => $model)); ?>