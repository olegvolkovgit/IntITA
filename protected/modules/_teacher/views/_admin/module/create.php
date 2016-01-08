<?php
/* @var $this ModuleController */
/* @var $model Module */
?>
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/index'); ?>')">
                Всі модулі</button>
        </li>

    </ul>
    <div class="page-header">
        <h4>Створити модуль</h4>
    </div>

<?php $this->renderPartial('_formAddModule', array('model' => $model)); ?>