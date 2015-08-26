<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 16.06.2015
 * Time: 17:07
 */
/* @var $model Teacher */
$this->breadcrumbs=array(
    'Викладачі'=>array('index'),
    'Роль'=>array('roles'),
    'Додати роль',
);
?>

    <h1>Додати роль</h1>

<?php $this->renderPartial('_formRole', array('model'=>$model, 'scenario' => 'create')); ?>