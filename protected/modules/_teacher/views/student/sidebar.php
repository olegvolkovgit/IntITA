<?php
/**
 * @var $model StudentReg
 */
?>
<li>
    <a href="#"  onclick="load('<?php echo Yii::app()->createUrl('/_teacher/cabinet/loadPage',
        array('page' => 'student'));?>','Студент')">
        <i class="fa fa-bar-chart-o fa-fw"></i>Студент<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#">
                Модулі
            </a>
        </li>
    </ul>
</li>