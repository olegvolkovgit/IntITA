<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 16.06.2015
 * Time: 15:45
 */
/* @var $dataProvider CActiveDataProvider */
?>
    <br>
    <br>
    <button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/createRole');?>">Додати роль</a>
    </button>
    <div class="page-header">
    <h2>Ролі викладачів</h2>
    </div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
    'htmlOptions'=>array('class'=>'grid-view custom'),
    'summaryText' => '',
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
                    'url' => 'Yii::app()->createUrl("/_admin/tmanage/showAttributes", array("role"=>$data->primaryKey))',
                    'label' => 'Атрибути ролі',
                ),
                'update' => array
                (
                    'label'=>'Редагувати',
                    //'imageUrl'=>StaticFilesHelper::createPath('image', 'editor', 'up.png'),
                    'url' => 'Yii::app()->createUrl("/_admin/tmanage/updateRole", array("id"=>$data->primaryKey))',
                ),

                'delete' => array
                (
                    'label'=>'Видалити',
                    'url' => 'Yii::app()->createUrl("/_admin/roles/delete", array("id"=>$data->primaryKey))',
                    'imageUrl'=>  StaticFilesHelper::createPath('image', 'editor', 'delete.png'),
                ),
            ),
        ),
    ),
)); ?>