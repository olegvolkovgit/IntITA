<?php
/**
 * @var $plainTaskAnswer PlainTaskAnswer
 * @var $teacherPlainTasks array
 * @var $mark boolean
 */
if (!empty($teacherPlainTasks)) {
    foreach ($teacherPlainTasks as $plainTaskAnswer) {
        $mark = $plainTaskAnswer->mark();?>
        <div class="panel panel-<?php echo ($mark) ? 'info' : 'success'; ?>">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa <?php echo ($mark) ? ' fa-check' : ' fa-exclamation'; ?> fa-fw"></i>
                    <em>Відповідь на задачу №<?= $plainTaskAnswer->id_plain_task; ?></em>
                </h3>
            </div>
            <div class="panel-body">
                Від кого : <?php echo $plainTaskAnswer->getStudentName();?> <br>
                Короткий опис відповіді : <?php echo $plainTaskAnswer->getShortDescription() ?> <br>
                <a href="#"
                   onclick="showPlainTask('<?php echo Yii::app()->createUrl('/_teacher/teacher/showPlainTask') ?>',
                       '<?php echo $plainTaskAnswer->id; ?>');"><?php echo ($mark) ? 'Перевірено' : 'Переглянути'; ?></a>
            </div>
        </div>
    <?php }
} else {
    echo "Нових задач немає.";
}
?>