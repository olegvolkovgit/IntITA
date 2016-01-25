<?php
/**
 * @var $plainTask PlainTaskAnswer
 * @var $teacherPlainTasks array
 * @var $mark PlainTaskMarks
 */
if ($teacherPlainTasks[0] != null) {
    foreach ($teacherPlainTasks as $plainTask) {
        $mark = $plainTask->mark(); ?>
        <div class="panel panel-<?php echo ($mark['mark']) ? 'info' : 'success'; ?>">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa <?php echo ($mark['mark']) ? ' fa-check' : ' fa-exclamation'; ?> fa-fw"></i>
                    <em>Відповідь на задачу №<?= $plainTask->id_plain_task; ?></em>
                </h3>
            </div>
            <div class="panel-body">
                Від кого : <?php echo $plainTask->getStudentName();?> <br>
                Короткий опис відповіді : <?php echo $plainTask->getShortDescription() ?> <br>
                <a href="#"
                   onclick="showPlainTask('<?php echo Yii::app()->createUrl('/_teacher/teacher/showPlainTask') ?>',
                       '<?php echo $plainTask->id ?>');"><?php echo ($mark['mark']) ? 'Перевірено' : 'Переглянути'; ?></a>
            </div>
        </div>
    <?php }
} else {
    echo "Нових задач немає.";
}
?>