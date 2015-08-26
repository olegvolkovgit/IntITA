<?php
/* @var $this RolesController */
/* @var $model Roles */

$this->breadcrumbs=array(
    'Ролі викладачів'=>array('index'),
    'Атрибути ролі '.$model->title_ua,
);

$this->menu=array(
    array('label'=>'Додати атрибут ролі', 'url'=>array('tmanage/addRoleAttribute/role/'.$model->id)),
    array('label'=>'Список ролей', 'url'=>array('tmanage/roles')),
);
?>

<h1>Атрибути ролі <?php echo $model->title_ua; ?></h1>

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
            'header'=>'Роль',
            'value'=>'TeacherHelper::getRoleTitle($data->role)',
        ),
        array(
            'header'=>'Тип',
            'value'=>'$data->type',
        ),
        array(
            'header'=>'Назва українською',
            'value'=>'$data->name_ua',
        ),
        array(
            'header'=>'Назва російською',
            'value'=>'$data->name_ru',
        ),
        array(
            'header'=>'Назва англійською',
            'value'=>'$data->name',
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
            'buttons'=>array
            (
                'update' => array
                (
                    'label'=>'Редагувати',
                    //'imageUrl'=>StaticFilesHelper::createPath('image', 'editor', 'up.png'),
                    'url' => 'Yii::app()->createUrl("roleAttribute/update", array("id"=>$data->primaryKey))',
                ),

                'delete' => array
                (
                    'label'=>'Видалити',
                    'url' => 'Yii::app()->createUrl("roleAttribute/delete", array("id"=>$data->primaryKey))',
                    'imageUrl'=>  StaticFilesHelper::createPath('image', 'editor', 'delete.png'),
                ),
            ),
        ),
    ),
)); ?>