<?php
/**
 * @var $model StudentReg
 */
?>
<li>
    <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/cabinet/accountantPage',
        array('user' => $model->id)); ?>', 'Панель бухгалтера')">
        <i class="fa fa-table fa-fw"></i> Бухгалтер</a>
</li>