<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 16.06.2015
 * Time: 17:07
 */
/* @var $model Teacher */
?>
    <br>
    <br>
    <button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/index');?>">Викладачі</a>
    </button>
    <br>
    <button type="button" class="btn btn-link">
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/roles');?>">Ролі</a>
    </button>
    <div class="page-header">
    <h2>Додати роль</h2>
    </div>
<?php $this->renderPartial('_formRole', array('model'=>$model, 'scenario' => 'create')); ?>