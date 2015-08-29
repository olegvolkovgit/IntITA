<?php
/* @var $dataProvider CActiveDataProvider */
?>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/roles.css" />

    <a href="<?php echo Yii::app()->createUrl('/_admin');?>">Система управління контентом IntITA - Головна</a>
    <br>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/create');?>">Додати викладача</a>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/admin');?>">Управління викладачами</a>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/roles');?>">Управління ролями викладачів</a>

    <h2>Викладачі</h2>

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
            'header'=>'Ролі'
        ),
        'email',
    ),
)); ?>