<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 15.07.2015
 * Time: 16:10
 */
$this->breadcrumbs=array(
    'Permissions' => Yii::app()->createUrl('permissions/index'),
    'Безкоштовні заняття'
);
?>
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/access.css" />

<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'freeLecturesGrid',
    'dataProvider' => $model->search(),
    'filter'=>$model,
    'summaryText'=>'',
    'pager' => array(
        'firstPageLabel'=>'<<',
        'lastPageLabel'=>'>>',
        'prevPageLabel'=>'<',
        'nextPageLabel'=>'>',
        'header'=>'',
    ),
    'columns' => array(
        array(
            'name' => 'ModuleTitle',
            'header'=>'Модуль',
            'type' => 'raw',
            'value' => '($data->idModule)? $data->ModuleTitle->title_ua : ""',
            'sortable'=>true,
            'htmlOptions'=>array('class'=>'titleModule'),
        ),
        array(
            'name' => 'order',
            'filter' => false,
            'type' => 'raw',
            'value' => '$data->order',
        ),
        array(
            'name' => 'title',
            'type' => 'raw',
            'value' => '$data->title',
            'htmlOptions'=>array('class'=>'titleLecture'),
        ),
        array(
            'name' => 'idType',
            'type' => 'raw',
            'value' => 'LectureHelper::getLectureTypeTitle($data->idType)',
        ),
        array(
            'name' => 'isFree',
            'type' => 'raw',
            'value' => '$data->isFree',
        ),
        array(
            'class'=>'CButtonColumn',
            'header'=>'Флажок',
            'template'=>'{free} {paid}',
            'buttons'=>array
            (
                'free' => array
                (
                    'label'=>'Безкоштовно',
                    'url'=>'Yii::app()->createUrl("permissions/setFreeLessons", array("id"=>$data->id))',
                    'imageUrl' => StaticFilesHelper::createPath('image', 'editor', 'free.png'),
                    'click'=>"function(){
                        $.fn.yiiGridView.update('freeLecturesGrid', {
                            type:'POST',
                            url:$(this).attr('href'),
                            success:function(data) {
                        $.fn.yiiGridView.update('freeLecturesGrid');
                        }
                        })
                        return false;
                    }
                    ",
                ),
                'paid' => array
                (
                    'label'=>'Платний',
                    'url'=>'Yii::app()->createUrl("permissions/setPaidLessons", array("id"=>$data->id))',
                    'imageUrl' => StaticFilesHelper::createPath('image', 'editor', 'paid.png'),
                    'click'=>"function(){
                        $.fn.yiiGridView.update('freeLecturesGrid', {
                            type:'POST',
                            url:$(this).attr('href'),
                            success:function(data) {
                        $.fn.yiiGridView.update('freeLecturesGrid');
                        }
                        })
                        return false;
                    }
                    ",
                ),
            ),
        ),
    ),
));
?>