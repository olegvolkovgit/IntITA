<?php
/**
 * @var $user StudentReg
 */
$user =Yii::app()->user->model;
?>
<li>
    <a href="#"  onclick="load('<?php echo Yii::app()->createUrl('/_teacher/cabinet/loadPage',
        array('page' => 'teacher_consultant'));?>','Викладач')">
        <i class="fa fa-bar-chart-o fa-fw"></i>Викладач<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#"
               onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_teacher_consultant/teacherConsultant/modules',
                   array("id" => $user->id)); ?>',
                   'Модулі')">
                Модулі
            </a>
        </li>
        <li>
            <a href="#"
               onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_teacher_consultant/teacherConsultant/students',
                   array("id" => $user->id)); ?>',
                   'Студенти')">
                Студенти
            </a>
        </li>
        <li>
            <a href="#"
               onclick="load('<?php echo Yii::app()->createUrl("/_teacher/_teacher_consultant/teacherConsultant/showTeacherPlainTaskList",
                   array("idTeacher" => $model->id)); ?>', 'Задачі до перевірки')">
                Всі задачі
            </a>
        </li>
    </ul>
</li>