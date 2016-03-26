<?php
/**
 * @var $teacher Teacher
 * @var $this CabinetController
 * @var $user StudentReg   */
?>
<li>
    <a href="#"  onclick="load('<?php echo Yii::app()->createUrl('/_teacher/cabinet/loadPage',
        array('page' => 'consultant'));?>','Консультант')">
        <i class="fa fa-bar-chart-o fa-fw"></i>Консультант<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#" onclick="showPlainTaskAnswer('<?php echo Yii::app()->createUrl('/_teacher/teacher/showTeacherPlainTaskList'); ?>',
                '<?php echo $teacher->user_id ?>')">
                Всі задачі
            </a>
        </li>
    </ul>
</li>