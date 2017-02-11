<?php
/**
 * @var $model StudentReg
 */
?>
<li>
    <a href="#/students" ng-controller="studentCtrl" ng-click="changeView('students')">
        <i class="fa fa-bar-chart-o fa-fw"></i>Студент<span class="fa arrow"></span>
        <span ng-cloak class="label label-success" ng-if="countOfNewPlainTasksMarks > 0">{{countOfNewPlainTasksMarks}}</span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#/students/courses">
                Доступні курси/модулі
            </a>
        </li>
        <li>
            <a href="#/students/consultations">
                Консультації
            </a>
        </li>
        <li id="nav">
            <a href="#/students/finances">
                Фінанси
            </a>
        </li>
        <li>
            <a href="#/students/plainTasks">
                Завдання з розгорнутою відповідю
                <span ng-cloak class="label label-success" ng-if="countOfNewPlainTasksMarks > 0">{{countOfNewPlainTasksMarks}}</span>
            </a>
        </li>
        <li>
            <a href="#/students/contacts">
                Контакти
            </a>
        </li>
        <?php if(UserStudent::studentHasSubgroup(Yii::app()->user->getId())) { ?>
        <li>
            <a href="#/students/offlineEducation">
                Офлайн навчання
            </a>
        </li>
        <?php } ?>
    </ul>
</li>