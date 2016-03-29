<?php
/* @var $this MessagesController */
/* @var $model Translate */
?>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/translate/index'); ?>')">
            Інтерфейсні повідомлення</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/translate/view', array('id' => $model->id_record)); ?>',
                    '<?="Переглянути повідомлення #".$model->id_record?>')">
            Переглянути</button>
    </li>
</ul>
<div class="updateTranslateForm">
    <?php $this->renderPartial('_form', array('model' => $model)); ?>
</div>

