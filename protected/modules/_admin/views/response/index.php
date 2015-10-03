<?php
/* @var $this ResponseController */
/* @var $dataProvider CActiveDataProvider */
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#response-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<br>

<h1>Відгуки про викладачів</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'response-grid',
    'summaryText' => '',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        array(
            'header' => 'Автор',
            'value' => 'ResponseHelper::getResponseAuthorName($data->who)',
        ),
        array(
            'header' => 'Про кого',
            'value' => 'ResponseHelper::getResponseAboutTeacherName($data->id)',
        ),
        'date',
        'text',
        array(
            'header' => 'Статус',
            'value' => 'ResponseHelper::isPublish($data->id)',
        ),
        'rate',
        array(
            'class'=>'CButtonColumn',
            'header'=>'Модерація',
            'template'=>'{free} {paid}',
            'buttons'=>array
            (
                'free' => array
                (
                    'label'=>'Опублікувати',
                    'url'=>'Yii::app()->createUrl("/_admin/response/setPublish", array("id"=>$data->id))',
                    'click'=>"function(){
                        $.fn.yiiGridView.update('response-grid', {
                            type:'POST',
                            url:$(this).attr('href'),
                            success:function(data) {
                        $.fn.yiiGridView.update('response-grid');
                        }
                        })
                        return false;
                    }
                    ",
                ),
                'paid' => array
                (
                    'label'=>'Скасувати',
                    'url'=>'Yii::app()->createUrl("/_admin/response/unsetPublish", array("id"=>$data->id))',
                    'click'=>"function(){
                        $.fn.yiiGridView.update('response-grid', {
                            type:'POST',
                            url:$(this).attr('href'),
                            success:function(data) {
                        $.fn.yiiGridView.update('response-grid');
                        }
                        })
                        return false;
                    }
                    ",
                ),
            ),
        ),
        array(
            'class'=>'CButtonColumn',
        ),
    ),
)); ?>
