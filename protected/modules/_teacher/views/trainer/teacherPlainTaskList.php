<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 14.12.2015
 * Time: 13:58
 * @var $teacherPlainTasks PlainTaskAnswer
 */?>
<?php foreach($teacherPlainTasks as $plainTask){ ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Відповідь на просту задачу</h3>
    </div>
    <div class="panel-body">
        Від кого : <?php echo $plainTask->getStudentName() ?> <br>
        Короткий опис відповіді : <?php echo $plainTask->getShortDescription() ?> <br>
        <a href="#" onclick="showPlainTask('<?php echo Yii::app()->createUrl('/_teacher/teacher/showPlainTask') ?>',
        '<?php echo $plainTask->id ?>');">Переглянути</a>
    </div>
</div>
<?php } ?>