<?php
/* @var $dataProvider CActiveDataProvider */
?>

    <button type="button" class="btn btn-primary"
        onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/createRole');?>')">Додати роль</button>
    <div class="page-header">
    <h4>Ролі викладачів</h4>
    </div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'roles',
    'dataProvider'=>$dataProvider,
    'htmlOptions'=>array(),
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
                    'click'=>"function(){
                                    $.fn.yiiGridView.update('roles', {
                                        type:'POST',
                                        url:$(this).attr('href'),
                                        success:function(data) {
                                              fillContainer(data);
                                        }
                                    })
                                    return false;
                              }
                     ",
                     'url' => 'Yii::app()->createUrl("/_teacher/_admin/teachers/showAttributes", array("role"=>$data->primaryKey))',
                    'label' => 'Атрибути ролі',
                ),
                'update' => array
                (
                    'click'=>"function(){
                                    $.fn.yiiGridView.update('roles', {
                                        type:'POST',
                                        url:$(this).attr('href'),
                                        success:function(data) {
                                                        fillContainer(data);
                                    }
                                    })
                                    return false;
                              }
                     ",
                    'label'=>'Редагувати',
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/teachers/updateRole", array("id"=>$data->primaryKey))',
                ),
                'delete' => array
                (
                    'click'=>"function(){
                                    if(confirm('Ви дійсно хочете видалити цю роль?'))
                                    $.fn.yiiGridView.update('roles', {
                                        type:'POST',
                                        url:$(this).attr('href'),
                                        success:function(data) {
                                                        fillContainer(data);
                                                        location.reload();
                                    }
                                    })
                                    return false;
                              }
                     ",
                    'label'=>'Видалити',
                    'url' => 'Yii::app()->createUrl("/_admin/roles/delete", array("id"=>$data->primaryKey))',
                    'imageUrl'=>  StaticFilesHelper::createPath('image', 'editor', 'delete.png'),
                ),
            ),
        ),
    ),
)); ?>
<script>
    function deleteRole()
    {

    }
</script>