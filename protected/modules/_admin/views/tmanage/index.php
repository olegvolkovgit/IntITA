<?php
/* @var $dataProvider CActiveDataProvider */
?>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/roles.css" />

    <br>
    <br>
    <button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/create');?>">Додати викладача</a>
    </button>
    <br>
    <button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/admin');?>">Управління викладачами</a>
    </button>
    <br>
    <button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/roles');?>">Управління ролями викладачів</a>
    </button>
    <div class="page-header">
    <h2>Викладачі</h2>
    </div>
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
        array(
            'header'=>'Статус',
            'value'=>'($data->isPrint == 1)?"активний":"видалено"',
        ),
    ),
)); ?>