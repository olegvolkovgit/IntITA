<?php
/**
 * @var $model StudentReg
 */
?>
<li>
    <a href="#/student" ng-controller="studentCtrl" ng-click="changeView('student')">
        <i class="fa fa-bar-chart-o fa-fw"></i>Студент<span class="fa arrow"></span>
        <span ng-cloak class="label label-success" ng-if="countOfNewPlainTasksMarks > 0">{{countOfNewPlainTasksMarks}}</span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#/student/courses">
                Доступні курси/модулі
            </a>
        </li>
        <li>
            <a href="#/student/consultations">
                Консультації
            </a>
        </li>
        <li>
            <a href="#/student/finances">
                Фінанси
            </a>
        </li>
        <li>
            <a href="#/student/plainTasks">
                Завдання з розгорнутою відповідю
                <span ng-cloak class="label label-success" ng-if="countOfNewPlainTasksMarks > 0">{{countOfNewPlainTasksMarks}}</span>
            </a>
        </li>
        <li>
            <a href="#/student/contacts">
                Контакти
            </a>
        </li>
        <?php if(UserStudent::studentHasSubgroup(Yii::app()->user->getId())) { ?>
        <li>
            <a href="#/student/offlineEducation">
                Офлайн навчання
            </a>
        </li>
        <?php } ?>
    </ul>
</li>