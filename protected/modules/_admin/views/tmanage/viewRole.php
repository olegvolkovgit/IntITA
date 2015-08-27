<?php
/* @var $this TmanageController */
/* @var $model Roles */
?>
    <a href="<?php echo Yii::app()->createUrl('/_admin');?>">Система управління контентом IntITA - Головна</a>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/roles');?>">Список ролей</a>

    <h1>Роль викладача  <?php echo $model->title_ua; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'title_en',
        'title_ru',
        'title_ua',
        'description',
    ),
)); ?>