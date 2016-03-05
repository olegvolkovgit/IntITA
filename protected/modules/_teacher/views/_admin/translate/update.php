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
</ul>
<div class="page-header">
    <h4>Редагувати повідомлення #<?php echo $model->id_record; ?></h4>
</div>
<div class="updateTranslateForm">
    <?php $this->renderPartial('_form', array('model' => $model)); ?>
</div>

