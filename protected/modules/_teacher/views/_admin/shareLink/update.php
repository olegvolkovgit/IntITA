<?php
/* @var $this ShareLinkController */
/* @var $model ShareLink */
?>
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('_teacher/_admin/shareLink/index'); ?>',
                        'Посилання на ресурси')">
                Всі посилання
            </button>
        </li>

        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('_teacher/_admin/shareLink/view', array('id' => $model->id)); ?>',
                        'Переглянути посилання')">
                Переглянути посилання
            </button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="deleteLink('<?php echo Yii::app()->createUrl("/_teacher/_admin/shareLink/delete"); ?>',
                        '<?= $model->id; ?>')">
                Видалити посилання
            </button>
        </li>
    </ul>

<?php $this->renderPartial('_form', array('model' => $model)); ?>