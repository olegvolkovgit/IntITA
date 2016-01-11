<?php
/* @var $this TmanageController */
/* @var $model Roles */
?>
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/roles'); ?>')">
                Список ролей</button>
        </li>
    </ul>
    <div class="page-header">
    <h4>Роль викладача  <?php echo $model->title_ua; ?></h4>
    </div>
<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'title_en',
        'title_ru',
        'title_ua',
        'description',
    ),
)); ?>