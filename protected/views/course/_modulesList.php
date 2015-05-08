<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 08.05.2015
 * Time: 17:50
 */
$editMode = 'true';
?>
<div class="courseModules">
<h2>Модулі</h2>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'modules-grid',
    'dataProvider' => $dataProvider,
    'emptyText' => 'У даному курсі модулів немає.',
    'columns' => array(
        array(
            'class'=>'CButtonColumn',
            'template'=>'{up}{down}{delete}',
            'headerHtmlOptions'=>array('style'=>'display:none'),
            'buttons'=>array
            (
                'htmlOptions'=>array('display' => 'none'),
                'delete' => array(
                    'imageUrl'=> Yii::app()->request->baseUrl."/images/delete.png",
                    'url' => 'Yii::app()->createUrl("module/unableLesson", array("idLecture"=>$data->primaryKey))',
                    'deleteConfirmation' => 'Вы уверены, что хотите удалить это занятие?',
                    'click'=>"function(){
                        $.fn.yiiGridView.update('modules-grid', {
                            type:'POST',
                            url:$(this).attr('href'),
                            success:function(data) {
                            $.fn.yiiGridView.update('modules-grid');
                            }
                        })
                        return false;
                    }
                    ",
                    'label' => 'Дезактивировать занятие',
                    'visible'=> $editMode,
                ),
                'up' => array
                (

                    'label'=>'Поднять занятие вверх на 1 позицию',   //Text label of the button.
                    'url' => 'Yii::app()->createUrl("module/upLesson", array("idLecture"=>$data->primaryKey))',
                    'imageUrl'=>Yii::app()->request->baseUrl."/images/up.png",  //Image URL of the button.
                    'options'=>array('class'=>'controlButtons;'), //HTML options for the button tag.
                    'click'=>"function(){
                        $.fn.yiiGridView.update('lectures-grid', {
                            type:'POST',
                            url:$(this).attr('href'),
                            success:function(data) {
                            $.fn.yiiGridView.update('modules-grid');
                            }
                        })
                        return false;
                    }
                    ",
                    'visible'=>$editMode,   //A PHP expression for determining whether the button is visible.
                ),

                'down' => array
                (

                    'label'=>'Опустить занятие вниз на 1 позицию',    //Text label of the button.
                    'url' => 'Yii::app()->createUrl("module/downLesson", array("idLecture"=>$data->primaryKey))',
                    'imageUrl'=>Yii::app()->request->baseUrl."/images/down.png",  //Image URL of the button.
                    'options'=>array('class'=>'controlButtons;'), //HTML options for the button tag.
                    'visible'=>$editMode,
                    'click'=>"function(){
                        $.fn.yiiGridView.update('modules-grid', {
                            type:'POST',
                            url:$(this).attr('href'),
                            success:function(data) {
                            $.fn.yiiGridView.update('modules-grid');
                            }
                        })
                        return false;
                    }
                    ",
                ),
            ),
        ),
        array(
            'class'=>'DataColumn',
            'name' => 'alias',
            'type' => 'raw',
            'value' =>'$data->order == 0 ? "Виключено":"Модуль {$data->order}."',
            'header'=>false,
            'htmlOptions'=>array('class'=>'aliasColumn'),
            'headerHtmlOptions'=>array('style'=>'width:0%; display:none'),
        ),
        array(
            'name' => 'module_name',
            'type' => 'raw',
            'header'=>false,
            'htmlOptions'=>array('class'=>'titleColumn'),
            'headerHtmlOptions'=>array('style'=>'width:0%; display:none'),
            'value' => 'CHtml::link(CHtml::encode($data->module_name), Yii::app()->createUrl("module/index", array("idModule" => $data->module_ID)))',
        ),
    ),
    'summaryText' => '',
));
?>
    </div>
