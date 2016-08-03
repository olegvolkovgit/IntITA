<?php
/**
 * @var $user StudentReg
 */
$user =Yii::app()->user->model;
?>
<li>
    <a href="#/teacherConsultant" ng-click="changeView('teacherConsultant')">
        <i class="fa fa-bar-chart-o fa-fw"></i>Викладач<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#/teacherConsultant/modules">
                Модулі
            </a>
        </li>
        <li>
            <a href="#/teacherConsultant/students">
                Студенти
            </a>
        </li>
        <li>
            <a href="#/teacherConsultant/tasks">
                Всі задачі
            </a>
        </li>
    </ul>
</li>