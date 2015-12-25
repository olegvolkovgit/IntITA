<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 22.12.2015
 * Time: 17:07
 */
?>

<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'roles.css'); ?>"/>
<div class="col-md-12">

    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/create'); ?>')">
                Додати викладача</button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/roles'); ?>')">
                Управління ролями викладачів</button>
        </li>
    </ul>

    <div class="page-header">
        <h4>Викладачі</h4>
    </div>
<?php
$this->widget('application.components.MyGridView', array(
    'id' => 'tmanage',
    'dataProvider' => $model->search(),
    'summaryText' => '',
    'pager' => array(
        'firstPageLabel' => '&#171;&#171;',
        'lastPageLabel' => '&#187;&#187;',
        'prevPageLabel' => '&#171;',
        'nextPageLabel' => '&#187;',
        'header' => '',
        'cssFile' => StaticFilesHelper::fullPathTo('css', 'pager.css'),
    ),
    'columns' => array(
        array(
            'header' => 'ПІБ',
            'value' => '"{$data->last_name} {$data->first_name} {$data->middle_name}"',
        ),
        'email',
        array(
            'header' => 'Статус',
            'value' => '($data->isPrint == 1)?"активний":"видалено"',
        ),
        array(
            'class' => 'CButtonColumn',
            'headerHtmlOptions' => array('style' => 'width:80px'),
            'buttons'=>array(
                'view' => array
                (
                    'click'=>"function(){
                                    $.fn.yiiGridView.update('tmanage', {
                                        type:'POST',
                                        url:$(this).attr('href'),
                                        success:function(data){
                                                        fillContainer(data);
                                    }
                                    })
                                    return false;
                              }
                     ",
                    'label'=>'Переглянути',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/teachers/showTeacher", array("id"=>$data->primaryKey))',
                ),
                'update' => array
                (
                    'click'=>"function(){
                                    $.fn.yiiGridView.update('tmanage', {
                                        type:'POST',
                                        url:$(this).attr('href'),
                                        success:function(data){
                                                        fillContainer(data);
                                    }
                                    })
                                    return false;
                              }
                     ",
                    'label'=>'Редагувати',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/teachers/update", array("id"=>$data->primaryKey))',
                ),
                'delete' => array
                (
                    'click'=>"function(){
                                    if(confirm('Ви дійсно хочете видалити вчителя?'))
                                    $.fn.yiiGridView.update('tmanage', {
                                        type:'POST',
                                        url:$(this).attr('href'),
                                        success:function(data){
                                                location.reload();
                                        }
                                    })
                                    return false;
                              }
                     ",
                    'label'=>'Видалити',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/teachers/delete", array("id"=>$data->primaryKey))',
                    'imageUrl'=>  StaticFilesHelper::createPath('image', 'editor', 'delete.png'),
            ),
        ),
    ),
    ),
)); ?>

