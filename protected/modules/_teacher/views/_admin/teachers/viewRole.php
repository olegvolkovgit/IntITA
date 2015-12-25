<?php
/* @var $this TmanageController */
/* @var $model Roles */
?>
    <br>
    <br>
    <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/teachers/roles');?>')">Список ролей</a>
    <div class="page-header">
    <h1>Роль викладача  <?php echo $model->title_ua; ?></h1>
    </div>
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