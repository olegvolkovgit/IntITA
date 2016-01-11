<?php
/* @var $this ConfigController */
/* @var $model Config */
?>

    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/config/index'); ?>')">
                Список налаштувань</button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/config/view',
                        array('id' => $model->id)); ?>')">Переглянути налаштування</button>
        </li>
    </ul>

    <div class="page-header">
        <h4>Редагувати налаштування <?php echo $model->param; ?></h4>
    </div>
<?php $this->renderPartial('_form', array('model' => $model)); ?>