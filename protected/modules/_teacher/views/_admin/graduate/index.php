<?php
/* @var $this GraduateController */
/* @var $dataProvider CActiveDataProvider */
?>
<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/graduate/create'); ?>',
                    'Додати випускника')">
            Додати випускника
        </button>
    </li>
</ul>
<?php

?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'graduate-grid',
    'dataProvider' => $model->search(),
    'summaryText' => '',
    'columns' => array(
        'first_name',
        'last_name',
        array(
            'header' => 'Аватар',
            'value' => 'StaticFilesHelper::createPath("image", "graduates", $data->avatar)',
            'type' => 'image',
            'htmlOptions'=>array('class' => 'imageClass'),
        ),
        'position',
        'work_place',
        array(
            'header' => 'Відгук',
            'value' => '$data->showRecall()',
            'htmlOptions' => array('class' => 'recall'),
        ),
        array(
            'class' => 'CButtonColumn',
            'headerHtmlOptions' => array('style' => 'width:80px'),
            'buttons' => array(
                'delete' => array
                (
                    'click' => "function(){
                                    showConfirm('Ви дійсно хочете видалити випускника?',$(this).attr('href'))
                                    return false;
                              }
                     ",
                    'label' => 'Видалити',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/graduate/delete", array("id"=>$data->id))',
                ),
                'view' => array
                (
                    'click' => "function(){
                                    $.fn.yiiGridView.update('graduate-grid', {
                                        type:'POST',
                                        url:$(this).attr('href'),
                                        success:function(data){
                                                        fillContainer(data);
                                    }
                                    })
                                    return false;
                              }
                     ",
                    'label' => 'Переглянути',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/graduate/view", array("id"=>$data->id))',
                ),
                'update' => array
                (
                    'click' => "function(){
                                    $.fn.yiiGridView.update('graduate-grid', {
                                        type:'POST',
                                        url:$(this).attr('href'),
                                        success:function(data){
                                                        fillContainer(data);
                                    }
                                    })
                                    return false;
                              }
                     ",
                    'label' => 'Редагувати',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/graduate/update", array("id"=>$data->id))',
                ),
            ),
        ),
    ),

)); ?>
