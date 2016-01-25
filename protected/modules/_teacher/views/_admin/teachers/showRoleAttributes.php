<?php
/* @var $this RolesController */
/* @var $model Roles */
?>
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/addRoleAttribute/role/',
                        array('id' => $model->id)); ?>')">
                Додати атрибут ролі</button>
        </li>
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/roles');?>')">
                Список ролей</button>
        </li>
    </ul>


    <div class="page-header">
    <h4>Атрибути ролі <?php echo $model->title_ua; ?></h4>
    </div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'roleAttribute',
    'dataProvider'=>$dataProvider,
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
                    'click'=>"function(){
                                    $.fn.yiiGridView.update('roleAttribute', {
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
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/teachers/updateRoleAttribute", array("id"=>$data->primaryKey))',
                ),

                'delete' => array
                (
                    'label'=>'Видалити',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/roleAttribute/delete", array("id"=>$data->primaryKey))',
                    'imageUrl'=>  StaticFilesHelper::createPath('image', 'editor', 'delete.png'),
                ),
            ),
        ),
    ),
)); ?>