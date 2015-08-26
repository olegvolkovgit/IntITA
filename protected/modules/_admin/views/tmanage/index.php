<?php
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
    array('label'=>'Додати викладача', 'url'=>array('/_admin/tmanage/create')),
    array('label'=>'Управління викладачами', 'url'=>array('/_admin/tmanage/admin')),
    array('label'=>'Управління ролями викладачів', 'url'=>array('/_admin/tmanage/roles')),
);
?>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/roles.css" />
    <h1>Викладачі</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'htmlOptions'=>array('class'=>'grid-view custom','id'=>'adminTeacherList'),
    'summaryText' => 'Показано викладачів {start} - {end} з {count}',
    'pager' => array(
        'firstPageLabel'=>'&#171;&#171;',
        'lastPageLabel'=>'&#187;&#187;',
        'prevPageLabel'=>'&#171;',
        'nextPageLabel'=>'&#187;',
        'header'=>'',
        'cssFile'=>Yii::app()->request->baseUrl.'/css/pager.css'
    ),
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
            'urlExpression'=>'Yii::app()->createUrl("/_admin/tmanage/showRoles", array("id"=>$data->teacher_id))',
            'header'=>'Author'
        ),
        array(
            'header'=>'Ролі',
            'value'=>'TeacherHelper::getTeachersRoles($data->teacher_id)',
        ),
        'email',
    ),
)); ?>