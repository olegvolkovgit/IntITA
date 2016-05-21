<?php
/* @var $this ConfigController */
/* @var $model Config */
?>
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/config/index'); ?>', 'Налаштування')">
                Список налаштувань
            </button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/config/view',
                        array('id' => $model->id)); ?>', '<?="Налаштування ".$model->param?>')">
                Переглянути налаштування
            </button>
        </li>
    </ul>
<?php $this->renderPartial('_form', array('model' => $model)); ?>