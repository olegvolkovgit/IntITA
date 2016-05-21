<?php
/**
 * @var $model StudentReg
 */
?>
<li id="nav">
    <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/cabinet/adminPage',
        array('user' => $model->id)); ?>', 'Панель адміністратора')">
        <i class="fa fa-table fa-fw"></i> Адміністратор</a>
</li>
