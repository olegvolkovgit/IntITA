<?php
/* @var $this ResponseController */
/* @var $dataProvider CActiveDataProvider */
/* @var $data Response */
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

<div class="page-header">
    <h4>Відгуки про викладачів</h4>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'response-grid',
    'summaryText' => '',
    'dataProvider'=>$model->search(),
//    'filter'=>$model,
    'columns'=>array(
        array(
            'header' => 'Автор',
            'value' => '$data->getResponseAuthorName()',
        ),
        array(
            'header' => 'Про кого',
            'value' => '$data->getResponseAboutTeacherName()',
        ),
        array(
            'header' => 'Дата відгуку',
            'value' => '$data->timeDesc()'
        ),
        array(
            'header' => 'Опис',
            'value' => '$data->shortDescription()',
//            'htmlOptions' => array('onclick' => 'load("Yii::app()->createUrl("/_teacher/_admin/response/view",array("id"=>$data->id))'),
        ),
        array(
            'header' => 'Статус',
            'value' => '$data->isPublish()',
        ),
        'rate',
        array(
            'class'=>'CButtonColumn',
            'header'=>'Модерація',
            'template'=>'{free} {paid} {view} {update} {delete}',
            'buttons'=>array
            (
                'free' => array
                (
                    'label'=>'Опублікувати',
                    'url'=>'Yii::app()->createUrl("/_teacher/_admin/response/setPublish", array("id"=>$data->id))',
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
                    'url'=>'Yii::app()->createUrl("/teacher/_admin/response/unsetPublish", array("id"=>$data->id))',
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
                'view' => array
                (
                    'label'=>'Опублікувати',
                    'url'=>'Yii::app()->createUrl("/_teacher/_admin/response/view", array("id"=>$data->id))',
                    'click'=>"function(){
                        $.fn.yiiGridView.update('response-grid', {
                            type:'POST',
                            url:$(this).attr('href'),
                            success:function(data) {
                                fillContainer(data);
                        }
                        })
                        return false;
                    }
                    ",
                ),
                'update' => array
                (
                    'label'=>'Опублікувати',
                    'url'=>'Yii::app()->createUrl("/_teacher/_admin/response/update", array("id"=>$data->id))',
                    'click'=>"function(){
                        $.fn.yiiGridView.update('response-grid', {
                            type:'POST',
                            url:$(this).attr('href'),
                            success:function(data) {
                                fillContainer(data);
                        }
                        })
                        return false;
                    }
                    ",
                ),
            ),
        ),
//        array(
//            'class'=>'CButtonColumn',
//            'headerHtmlOptions' => array('style' => 'width:80px'),
//        ),
    ),
)); ?>
