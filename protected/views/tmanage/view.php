<?php
/* @var $model Teacher */
$this->breadcrumbs=array(
    'Викладачі'=>array('index'),
    "{$model->last_name} {$model->first_name} {$model->middle_name}",
);
$this->menu=array(
    array('label'=>'Список викладачів', 'url'=>array('index')),
    array('label'=>'Додати викладача', 'url'=>array('create')),
    array('label'=>'Оновити', 'url'=>array('update', 'id'=>$model->teacher_id)),
    array('label'=>'Видалити', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->teacher_id),'confirm'=>'Ви впевнені?')),
    array('label'=>'Управління викладачами', 'url'=>array('admin')),
);
?>

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
        'email',
        'tel',
        'skype',
        'rate_knowledge',
        'rate_efficiency',
        'rate_relations',
        'user_id',
    ),
)); ?>