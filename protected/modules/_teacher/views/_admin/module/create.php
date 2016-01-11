<?php
/* @var $this ModuleController */
/* @var $model Module */
?>
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/index'); ?>',
                        'Модулі')">
                Всі модулі</button>
        </li>

    </ul>

<?php $this->renderPartial('_formAddModule', array('model' => $model)); ?>