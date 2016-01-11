<?php
/* @var $this TmanageController */
/* @var $model RoleAttribute */

?>
    <ul class="list-inline">
        <li>
            <button type="button" class="btn btn-primary"
                    onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/teachers/roles'); ?>')">
                Список ролей</button>
        </li>
    </ul>

    <div class="page-header">
    <h4>Додати атрибут ролі</h4>
    </div>
<?php $this->renderPartial('_formRoleAttribute', array('model'=>$model)); ?>