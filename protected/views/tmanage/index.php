<?php
/* @var $dataProvider CActiveDataProvider */
$this->breadcrumbs=array(
    'Викладачі',
);
$this->menu=array(
    array('label'=>'Додати викладача', 'url'=>array('create')),
    array('label'=>'Управління викладачами', 'url'=>array('admin')),
);
?>

    <h1>Викладачі</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    //'cssFile'=>Yii::app()->baseUrl . '/css/customCGridView.css',
    'htmlOptions'=>array('class'=>'grid-view custom'),
    'summaryText' => 'Показано викладачів {start} - {end} з {count}',
    'columns'=>array(

        array(
            'header'=>'Фото',
            'value'=>'StaticFilesHelper::createPath("image", "teachers",$data->foto_url)',
            'type'=>'image',
        ),
        array(
            'header'=>'ПІБ',
            'value'=>'"{$data->last_name} {$data->first_name} {$data->middle_name}"',
        ),
        array(
            'class'=>'CLinkColumn',
            'label'=>'Ролі викладача',
            'urlExpression'=>'"tmanage/showRoles?id=".$data->teacher_id',
            'header'=>'Author'
        ),
        array(
            'header'=>'Ролі',
            'value'=>'TeacherHelper::getTeachersRoles($data->teacher_id)',
        ),
        'email',
    ),
)); ?>