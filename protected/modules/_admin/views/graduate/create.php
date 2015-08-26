<?php
/* @var $this GraduateController */
/* @var $model Graduate */
?>
    <br>
    <a href="/_admin/graduate/index">Список випускників</a>
    <br>
    <a href="/_admin/graduate/admin">Управління випускниками</a>

<h1>Create Graduate</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>