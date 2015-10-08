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
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/index');?>">Викладачі</a>
    <br>
    <a href="<?php echo Yii::app()->createUrl('/_admin/tmanage/roles');?>">Ролі</a>

    <h2>Додати роль</h2>

<?php $this->renderPartial('_formRole', array('model'=>$model, 'scenario' => 'create')); ?>