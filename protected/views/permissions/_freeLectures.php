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
$dataProvider = $model->search();

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'freeLecturesGrid',
    'dataProvider' => $model->search(),
    'summaryText'=>'',
    'columns' => array(
        array(
            'name' => 'Модуль',
            'type' => 'raw',
            'value' => 'ModuleHelper::getModuleName($data->idModule)',
        ),
        array(
            'name' => 'Порядок',
            'type' => 'raw',
            'value' => '$data->order',
        ),
        array(
            'name' => 'Назва',
            'type' => 'raw',
            'value' => '$data->title',
        ),
        array(
            'name' => 'Тип заняття',
            'type' => 'raw',
            'value' => '$data->idType',
        ),
        array(
            'name' => 'Доступ',
            'type' => 'raw',
            'value' => '$data->isFree',
        ),
//        array(
//            'class'=>'CButtonColumn',
//            'template'=>'{delete}',
//            'buttons'=>array
//            (
//                'delete' => array
//                (
//                    'label'=>'Delete',
//                    //'url'=>'Yii::app()->createUrl("permissions/delete", array("id"=>$data->id_user, "resource"=>$data->id_module))',
//                    'imageUrl' => StaticFilesHelper::createPath('image', 'editor', 'delete.png'),
//                    'click'=>"function(){
//                        $.fn.yiiGridView.update('access_grid', {
//                            type:'POST',
//                            url:$(this).attr('href'),
//                            success:function(data) {
//                        $.fn.yiiGridView.update('access_grid');
//                        }
//                        })
//                        return false;
//                    }
//                    ",
//                ),
//            ),
//        ),
    ),
));
?>