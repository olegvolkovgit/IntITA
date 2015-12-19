<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 15.12.2015
 * Time: 17:41
 *
 * @var $teacher Teacher
 * @var $role Roles
 * @var $this CabinetController
 * @var $user StudentReg   */
 ?>

<li>
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
        <?php echo $role->title_en ?><span class="caret"></span></a>
    <ul class="dropdown-menu">
        <li><a href="#" onclick="loadPage('<?php echo Yii::app()->createUrl('/_teacher/cabinet/loadPage',
                array('page' => $role->title_en, 'teacher' => $teacher->teacher_id));?>','<?php echo $role->title_en ?>')">
                <span class="glyphicon glyphicon-list" aria-hidden="true"></span>Дошка</a>
        </li>
        <li><a href="#" ng-click="manageConsult('<?php echo Yii::app()->createUrl('/_teacher/teacher/manageConsult') ?>')">
                Управління консультантами</a></li>
        <li><a href="#">Something else here</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="#">Separated link</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="#">One more separated link</a></li>
    </ul>

</li>