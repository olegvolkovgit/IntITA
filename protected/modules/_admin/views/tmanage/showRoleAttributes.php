<?php
/* @var $this RolesController */
/* @var $model Roles */
?>
    <br>
    <br>
    <button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/addRoleAttribute/role/', array('id' => $model->id));?>">
        Додати атрибут ролі
    </a>
    </button>
    <br>
    <button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/roles');?>">Список ролей</a>
    </button>
    <div class="page-header">
    <h2>Атрибути ролі <?php echo $model->title_ua; ?></h2>
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
            'header'=>'Роль',
            'value'=>'Roles::getRoleTitle($data->role)',
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
                    'url' => 'Yii::app()->createUrl("/_admin/tmanage/updateRoleAttribute", array("id"=>$data->primaryKey))',
                ),

                'delete' => array
                (
                    'label'=>'Видалити',
                    'url' => 'Yii::app()->createUrl("/_admin/roleAttribute/delete", array("id"=>$data->primaryKey))',
                    'imageUrl'=>  StaticFilesHelper::createPath('image', 'editor', 'delete.png'),
                ),
            ),
        ),
    ),
)); ?>