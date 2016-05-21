<?php
/**
 * @var $model StudentReg
 */
 ?>
<li>
    <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/cabinet/loadPage',
        array('page' => 'trainer'));?>','Тренер')">
        <i class="fa fa-bar-chart-o fa-fw"></i>Тренер<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_trainer/trainer/students',
                array('id' => $model->id)) ?>',
                'Студенти')">
                Студенти
            </a>
        </li>
    </ul>
</li>
