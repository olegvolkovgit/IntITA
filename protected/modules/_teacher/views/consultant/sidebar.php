<?php
/**
 * @var $teacher Teacher
 * @var $role Roles
 * @var $this CabinetController
 * @var $user StudentReg   */
?>
<li>
    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i><?php echo $role->title_ua; ?><span class="fa arrow"></span></a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#" onclick="loadPage('<?php echo Yii::app()->createUrl('/_teacher/cabinet/loadPage',
                array('page' => $role->title_en));?>','<?php echo $role->title_en ?>')">Дошка</a>
        </li>
        <li>
            <a href="#" onclick="showPlainTaskAnswer('<?php echo Yii::app()->createUrl('/_teacher/teacher/showTeacherPlainTaskList'); ?>',
                '<?php echo $teacher->teacher_id ?>')">
                Всі задачі
            </a>
        </li>
    </ul>
</li>