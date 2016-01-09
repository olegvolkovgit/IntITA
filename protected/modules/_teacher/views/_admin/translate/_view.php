<?php
/* @var $this MessagesController */
/* @var $data Translate */
?>

<div class="view">
    <b><?php echo CHtml::encode($data->getAttributeLabel('id_record')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id_record), array('view', 'id' => $data->id_record)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::encode($data->id); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('language')); ?>:</b>
    <?php echo CHtml::encode($data->language); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('translation')); ?>:</b>
    <?php echo CHtml::encode($data->translation); ?>
    <br/>
</div>