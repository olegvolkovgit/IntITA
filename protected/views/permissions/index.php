<?php
/* @var $this PermissionsController */

$this->breadcrumbs=array(
	'Permissions',
);
$alert = 'Ви впевнені, що хочете видалити цей запис?';
?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/access.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/access.css" />

<a href="#form">
    <div id="enter_button_2" onclick="addAccess()">Додати запис</div>
</a>

<?php
$dataProvider = $model->search();

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'access_grid',
    'dataProvider' => $dataProvider,
    'filter' => $model,
    'columns' => array(
        array(
            'class'=>'CButtonColumn',
            'template'=>'{delete}{edit}',
            'buttons'=>array
            (
                'delete' => array
                (
                    'label'=>'Delete',
                    'url'=>'Yii::app()->createUrl("permissions/delete", array("id"=>$data->id_user, "resource"=>$data->id_resource))',
                    'imageUrl' => StaticFilesHelper::createPath('image', 'editor', 'delete.png'),
                    'options' => array(// this is the 'html' array but we specify the 'ajax' element
                        'confirm' => $alert,
                        'class'=>'deleteButton',
                        'ajax' => array(
                            'type' => 'POST',
                            'url' => "js:$(this).attr('href')", // ajax post will use 'url' specified above
                            'success' => 'function(data){
                                if(data == "true"){
                                    $.fn.yiiGridView.update("access_grid");
                                    return false;
                                }else{
                                    window.location="/IntITA/permissions/delete";
                                    return false;
                                }
                            }',
                        ),
                    ),
                ),
                'edit' => array
                (
                    'label'=>'Edit',
                    'imageUrl'=>StaticFilesHelper::createPath('image', 'editor', 'edt_20px.png'),
                    'url' => 'Yii::app()->createUrl("permissions/edit", array("user"=>$data->id_user, "resource"=>$data->id_resource))',
                    'click'=>"function(){
                        $.fn.yiiGridView.update('access_grid', {
                            type:'POST',
                            url:$(this).attr('href'),
                            success:function(data) {
                        $.fn.yiiGridView.update('access_grid');
                        }
                        })
                        return false;
                    }
                    ",
                    'options' => array(
                        'class'=>'editButton',
                    ),
                ),
            ),
        ),
        array(
            'name' => 'User',
            'type' => 'raw',
            'value' => 'AccessHelper::getUserName($data->id_user)',
        ),
//        array(
//            'name' => 'Email',
//            'type' => 'raw',
//            'value' => 'StudentReg::model()->findByPk($data->id_user)->email',
//        ),
        array(
            'name' => 'Role',
            'type' => 'raw',
            'value' => 'AccessHelper::getRole($data->id_user)',
        ),
//        array(
//            'name' => 'Resource',
//            'type' => 'raw',
//            'value' => 'AccessHelper::getResourceDescription($data->id_resource)',
//        ),
//        array(
//            'name' => 'READ',
//            'type' => 'raw',
//            'value' => 'AccessHelper::getFlag($data->rights, "read")',
//        ),
//        array(
//            'name' => 'EDIT',
//            'type' => 'raw',
//            'value' => 'AccessHelper::getFlag($data->rights, "edit")',
//        ),
//        array(
//            'name' => 'CREATE',
//            'type' => 'raw',
//            'value' => 'AccessHelper::getFlag($data->rights, "create")',
//        ),
//        array(
//            'name' => 'DELETE',
//            'type' => 'raw',
//            'value' => 'AccessHelper::getFlag($data->rights, "delete")',
//        ),
    ),
));
?>

<?php //$this->renderPartial('_add', array('model' => $model));?>

