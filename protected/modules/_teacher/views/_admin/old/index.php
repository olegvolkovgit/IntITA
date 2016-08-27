<?php
/* @var $this PermissionsController */
/* @var $dataProvider CActiveDataProvider */

$alert = 'Ви впевнені, що хочете видалити цей запис?';
Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){
	$('#access-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'access.css'); ?>"/>

<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary" ng-click="changeView('configuration/old/addaccess')">
            Додати запис</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary" ng-click="changeView('configuration/old/changestatus')">
            Змінити статус користувача</button>
    </li>
</ul>

<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'access_grid',
    'dataProvider' => $model->search(),
    'summaryText' => '',
    'pager' => array(
        'firstPageLabel' => '&#171;&#171;',
        'lastPageLabel' => '&#187;&#187;',
        'prevPageLabel' => '&#171;',
        'nextPageLabel' => '&#187;',
        'header' => '',
        'cssFile' => StaticFilesHelper::fullPathTo('css', 'pager.css')
    ),
    'columns' => array(
        array(
            'class' => 'CButtonColumn',
            'template' => '{delete}',
            'deleteConfirmation' => "js:'Запись с ID '+$(this).parent().parent().children(':first-child').text()+' будет удалена! Продолжить?'",
            'buttons' => array
            (
                'delete' => array
                (
                    'url' => 'Yii::app()->createUrl("/_teacher/_admin/old/delete", array("id"=>$data->id_user, "resource"=>$data->id_module))',
                    'imageUrl' => StaticFilesHelper::createPath('image', 'editor', 'delete.png'),
                    'click' => "function(){
                                    showConfirm('Ви дійсно хочете видалити права доступу?',$(this).attr('href'))
                                    return false;
                              }
                     ",
                    'label' => 'Видалити',

                ),
            ),
        ),
        array(
            'name' => 'User',
            'type' => 'raw',
            'value' => 'StudentReg::getUserName($data->id_user)',
        ),
        array(
            'name' => 'Email',
            'type' => 'raw',
            'value' => 'StudentReg::model()->findByPk($data->id_user)->email',
        ),
        array(
            'name' => 'Role',
            'type' => 'raw',
            'value' => 'StudentReg::getRole($data->id_user)',
        ),
        array(
            'name' => 'Resource',
            'type' => 'raw',
            'value' => 'CHtml::encode(Module::getResourceDescription($data->id_module))',
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