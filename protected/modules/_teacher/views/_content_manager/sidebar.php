<?php
/**
 * @var $model StudentReg
 */
?>
<li>
    <a href="#"  onclick="load('<?php echo Yii::app()->createUrl('/_teacher/cabinet/loadPage',
        array('page' => 'content_manager'));?>','Контент менеджер')">
        <i class="fa fa-bar-chart-o fa-fw"></i>Контент менеджер
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#"
               onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_content_manager/contentManager/authors'); ?>',
                   'Автори модулів')">
                Автори модулів
            </a>
        </li>
        <li>
            <a href="#"
               onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_content_manager/contentManager/consultants'); ?>',
                   'Консультанти для модулів')">
                Консультанти
            </a>
        </li>
        <li>
            <a href="#"
               onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_content_manager/contentManager/teacherConsultants'); ?>',
                   'Викладачі')">
                Викладачі
            </a>
        </li>
        <li>
            <a href="#"
               onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/verifyContent/index'); ?>',
                   'Контент лекцій')">
                Контент лекцій</a>
        </li>
        <li>
            <a href="#"
               onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/module/index'); ?>',
                   'Модулі')">
                Модулі</a>
        </li>
        <li>
        <li>
            <a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/coursemanage/index'); ?>',
                               'Курси')">
                Курси</a></li>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('revision/index'); ?>" class="active" target="_blank">
            Всі ревізії занять</a>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('moduleRevision/index'); ?>" class="active" target="_blank">
                Всі ревізії модулів</a>
        </li>
        <li>
            <a href="<?php echo Yii::app()->createUrl('courseRevision/index'); ?>" class="active" target="_blank">
                Всі ревізії курсів</a>
        </li>
        <li>
            <?php $p=45?>
            <a href="#"
               onclick="load('<?php echo Yii::app()->createUrl("/_teacher/_content_manager/contentManager/statusOfModules", array('id' => 0)); ?>',
                   'Стан модулів')">
                Стан модулів
            </a>
        </li>
        <li>
            <a href="#"
               onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_content_manager/contentManager/statusOfCourses'); ?>',
                   'Стан курсів')">
                Стан курсів
            </a>
        </li>
    </ul>
</li>