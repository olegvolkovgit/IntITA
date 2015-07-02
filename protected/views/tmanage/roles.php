<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 16.06.2015
 * Time: 15:45
 */
/* @var $dataProvider CActiveDataProvider */
$this->breadcrumbs=array(
    'Викладачі'=>array('index'),
    'Ролі викладачів'
);
$this->menu=array(
    array('label'=>'Додати роль', 'url'=>array('createRole')),
);
?>
    <h2>Ролі викладачів</h2>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'htmlOptions'=>array('class'=>'grid-view custom'),
    'summaryText' => '',
    'columns'=>array(
        array(
            'header'=>'ID',
            'value'=>'$data->id',
        ),
        array(
            'header'=>'Назва українською',
            'value'=>'$data->title_ua',
        ),
        array(
            'header'=>'Назва російською',
            'value'=>'$data->title_ru',
        ),
        array(
            'header'=>'Назва англійською',
            'value'=>'$data->title_en',
        ),
        array(
            'header'=>'Опис',
            'value'=>'$data->description',
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{view}{update}{delete}',
            'buttons'=>array
            (
                'view' => array(
                    //'imageUrl'=>  StaticFilesHelper::createPath('image', 'editor', 'delete.png'),
                    'url' => 'Yii::app()->createUrl("tmanage/showAttributes", array("role"=>$data->primaryKey))',
                    'label' => 'Атрибути ролі',
                ),
                'update' => array
                (
                    'label'=>'Редагувати',
                    //'imageUrl'=>StaticFilesHelper::createPath('image', 'editor', 'up.png'),
                    'url' => 'Yii::app()->createUrl("tmanage/updateRole", array("id"=>$data->primaryKey))',
                ),

                'delete' => array
                (
                    'label'=>'Видалити',
                    'url' => 'Yii::app()->createUrl("roles/delete", array("id"=>$data->primaryKey))',
                    'imageUrl'=>  StaticFilesHelper::createPath('image', 'editor', 'delete.png'),
                ),
            ),
        ),
    ),
)); ?>