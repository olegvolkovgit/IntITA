<?php
/* @var $this GraduateController */
/* @var $model Graduate */
?>
<br>
<br>
<button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/graduate/create'); ?>">Додати випускника</a>
</button>
<br>
<button type="button" class="btn btn-link">
    <a href="#"
       onclick="deletePhoto('<?php echo $model->id; ?>', '<?php echo $model->first_name . " " . $model->last_name; ?>');">
        Видалити фото випускника</a>
</button>
<br>
<button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/graduate/index'); ?>">Список випускників</a>
</button>
<br>
<button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/graduate/view', array('id' => $model->id)); ?>">Переглянути
        інформацію про випускника
    </a>
</button>
<div class="page-header">
    <h1>Редагувати інформацію про <?php echo $model->first_name . " " . $model->last_name; ?></h1>
</div>
<?php $this->renderPartial('_form', array('model' => $model)); ?>

<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'graduate.js'); ?>"></script>