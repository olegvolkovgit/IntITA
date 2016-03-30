<?php
/**
 * @var $user StudentReg
 */
 ?>
<li>
    <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/cabinet/loadPage',
        array('page' => 'trainer'));?>','Тренер')">
        <i class="fa fa-bar-chart-o fa-fw"></i>Тренер<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/trainer/students',
                array('id' => $user->id)) ?>',
                'Студенти')">
                Студенти
            </a>
        </li>
        <li>
            <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/teacher/manageConsult') ?>',
            'Управління задачами')">
                Консультанти для задач
            </a>
        </li>
    </ul>
</li>
