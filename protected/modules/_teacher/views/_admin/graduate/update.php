<?php
/* @var $this GraduateController */
/* @var $model Graduate */
?>
<br>
<br>
    <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/graduate/create'); ?>')">Додати випускника</a>
<br>
    <a href="#"
       onclick="deletePhoto('<?php echo Yii::app()->createUrl('/_teacher/_admin/graduate/deletePhoto'); ?>',
           '<?php echo $model->id; ?>', '<?php echo $model->first_name . " " . $model->last_name; ?>');">
        Видалити фото випускника</a>
<br>
    <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/graduate/index'); ?>')">Список випускників</a>
<br>
    <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/graduate/view', array('id' => $model->id)); ?>')">
        Переглянути інформацію про випускника
    </a>
<div class="page-header">
    <h1>Редагувати інформацію про <?php echo $model->first_name . " " . $model->last_name; ?></h1>
</div>
<?php $this->renderPartial('_form', array('model' => $model)); ?>

<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'graduate.js'); ?>"></script>