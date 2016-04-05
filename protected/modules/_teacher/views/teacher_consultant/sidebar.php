<?php
/**
 * @var $user StudentReg
 */
?>
<li>
    <a href="#"  onclick="load('<?php echo Yii::app()->createUrl('/_teacher/cabinet/loadPage',
        array('page' => 'teacher_consultant'));?>','Викладач')">
        <i class="fa fa-bar-chart-o fa-fw"></i>Викладач<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#">
                Модулі
            </a>
        </li>
        <li>
            <a href="#">
                Студенти
            </a>
        </li>
    </ul>
</li>