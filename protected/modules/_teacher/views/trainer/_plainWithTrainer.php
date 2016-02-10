<?php
/**
 * @var $task PlainTaskAnswer
 */
?>
<?php if (!empty($tasks)){ ?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="consultTasksTable">
                <thead>
                <tr>
                    <th>Номер задачі</th>
                    <th>Студент</th>
                    <th>Відповідь</th>
                    <th>Модуль</th>
                    <th>Консультант</th>
                    <th>Управління</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($tasks as $task) {
                    $module = $task->getModule();
                    if ($module) {
                        ?>
                        <tr>
                            <td><?php echo $task->id; ?></td>
                            <td><?php echo $task->getStudentName(); ?></td>
                            <td><?php echo $task->getShortDescription(); ?></td>
                            <td><?php echo $module->title_ua ?></td>
                            <td><?php echo $task->getConsultant()->getName() ?></td>
                            <td>
                                <a href="#" ng-click='changeConsult("<?php echo $task->id ?>",
                    "<?php echo Yii::app()->createUrl('_teacher/teacher/changeConsultant') ?>")'>
                                    <img
                                        src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'restore.png') ?>"
                                </a>
                                <a href="#" ng-click='removeConsult("<?php echo $task->id ?>",
                    "<?php echo Yii::app()->createUrl('_teacher/teacher/deleteConsultant') ?>")'>
                                    <img
                                        src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'delete.png') ?>"
                                </a>
                            </td>
                        </tr>
                    <?php }
                }}
                else echo 'Немає задач з консультантами';?>
                </tbody>
            </table>
        </div>
    </div>
</div>

