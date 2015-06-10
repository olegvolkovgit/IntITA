<?php
/* @var $this PermissionsController */
/* @var $dataProvider CActiveDataProvider*/

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

<a href="#formTeacher">
    <div id="addTeacherPermissions" onclick="addTeacherAccess()">Надати права викладача</div>
</a>

<a href="#formNewTeacher">
    <div id="addNewTeacher" onclick="addTeacher()">Зробити викладачем</div>
</a>

<?php
$dataProvider = $model->search();

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'access_grid',
    'dataProvider' => $dataProvider,
    'summaryText'=>'',
    'columns' => array(
        array(
            'class'=>'CButtonColumn',
            'template'=>'{delete}',
            'deleteConfirmation'=>"js:'Запись с ID '+$(this).parent().parent().children(':first-child').text()+' будет удалена! Продолжить?'",
            'buttons'=>array
            (
                'delete' => array
                (
                    'label'=>'Delete',
                    'url'=>'Yii::app()->createUrl("permissions/delete", array("id"=>$data->id_user, "resource"=>$data->id_resource))',
                    'imageUrl' => StaticFilesHelper::createPath('image', 'editor', 'delete.png'),
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
                ),
            ),
        ),
        array(
            'name' => 'User',
            'type' => 'raw',
            'value' => 'AccessHelper::getUserName($data->id_user)',
        ),
        array(
            'name' => 'Email',
            'type' => 'raw',
            'value' => 'StudentReg::model()->findByPk($data->id_user)->email',
        ),
        array(
            'name' => 'Role',
            'type' => 'raw',
            'value' => 'AccessHelper::getRole($data->id_user)',
        ),
        array(
            'name' => 'Resource',
            'type' => 'raw',
            'value' => 'AccessHelper::getResourceDescription($data->id_resource)',
        ),
        array(
            'name' => 'READ',
            'type' => 'raw',
            'value' => 'AccessHelper::getFlag($data->rights, "read")',
        ),
        array(
            'name' => 'EDIT',
            'type' => 'raw',
            'value' => 'AccessHelper::getFlag($data->rights, "edit")',
        ),
        array(
            'name' => 'CREATE',
            'type' => 'raw',
            'value' => 'AccessHelper::getFlag($data->rights, "create")',
        ),
        array(
            'name' => 'DELETE',
            'type' => 'raw',
            'value' => 'AccessHelper::getFlag($data->rights, "delete")',
        ),
    ),
));
?>

<?php $this->renderPartial('_add', array('model' => $model));?>
<?php $this->renderPartial('_addTeacherAccess', array('model' => $model));?>
<?php $this->renderPartial('_addTeacher', array('model' => $model));?>

