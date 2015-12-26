<?php
/* @var $this GraduateController */
/* @var $dataProvider CActiveDataProvider */
?>
    <ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary"
                onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/graduate/create'); ?>')">
            Додати випускника</button>
    </li>
    </ul>

<div class="page-header">
    <h4>Випускники</h4>
</div>
<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#graduate-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
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
        ),
        'position',
        'work_place',
        array(
            'header' => 'Відгук',
            'value' => '$data->recall',
            'htmlOptions' => array('class' => 'recall'),
        ),
        array(
            'class' => 'CButtonColumn',
            'headerHtmlOptions' => array('style' => 'width:80px'),
            'buttons'=>array(
                'view' => array
                (
                    'click'=>"function(){
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
                    'label'=>'Переглянути',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/graduate/view", array("id"=>$data->id))',
                ),
                'update' => array
                (
                    'click'=>"function(){
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
                    'label'=>'Редагувати',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/graduate/update", array("id"=>$data->id))',
                ),
            ),
        ),
    ),

)); ?>
