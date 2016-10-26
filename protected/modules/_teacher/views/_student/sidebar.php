<?php
/**
 * @var $model StudentReg
 */
?>
<li>
    <a href="#/students" ng-controller="studentCtrl" ng-click="changeView('students')">
        <i class="fa fa-bar-chart-o fa-fw"></i>Студент<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#/students/courses">
                Курси / модулі
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
        <?php if(UserStudent::studentHasSubgroup(Yii::app()->user->getId())) { ?>
        <li>
            <a href="#/students/offlineEducation">
                Оффлайн навчання
            </a>
        </li>
        <?php } ?>
    </ul>
</li>