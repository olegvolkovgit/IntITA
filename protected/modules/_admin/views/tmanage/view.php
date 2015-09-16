<?php
/* @var $model Teacher */
?>
    <a href="<?php echo Yii::app()->createUrl('/_admin');?>">Система управління контентом IntITA - Головна</a>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/index');?>">Викладачі</a>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/create');?>">Додати викладача</a>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/admin');?>">Управління викладачами</a>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/update', array('id' => $model->teacher_id));?>">Оновити інформацію про викладача</a>

    <h1>Викладач <?php print "{$model->last_name} {$model->first_name} {$model->middle_name}"; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'id'=>'teacher-view',
    'data'=>$model,
    'attributes'=>array(
        'teacher_id',
        'first_name',
        'middle_name',
        'last_name',
        array(
            'name'=>'Фото',
            'value'=>StaticFilesHelper::createPath("image", "teachers",$model->foto_url),
            'type'=>'image',
        ),
        array(
            'name'=>'profile_text_first',
            'type'=>'raw',
        ),
        array(
            'name'=>'profile_text_short',
            'type'=>'raw',
        ),
        array(
            'name'=>'profile_text_last',
            'type'=>'raw',
        ),
        'readMoreLink',
        'tel',
        'skype',
        'rate_knowledge',
        'rate_efficiency',
        'rate_relations',
        'first_name_en',
        'middle_name_en',
        'last_name_en',
        'isPrint'
    ),
)); ?>