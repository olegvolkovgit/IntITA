<?php
/**
 * @var $plainTaskAnswer PlainTaskAnswer
 * @var $teacherPlainTasks array
 * @var $mark boolean
 */
if (!empty($teacherPlainTasks)) { ?>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="tasksTable">
                        <thead>
                        <tr>
                            <th style="width: 3%"></th>
                            <th style="width: 15%">Курс/модуль</th>
                            <th style="width: 20%">Задача</th>
                            <th style="width: 15%">Користувач</th>
                            <th>Відповідь</th>
                            <th style="width: 10%">Оцінка</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($teacherPlainTasks as $plainTaskAnswer) {
                            $mark = $plainTaskAnswer->mark(); ?>
                            <tr onclick="showPlainTask('<?php echo Yii::app()->createUrl('/_teacher/teacher/showPlainTask') ?>',
                                '<?php echo $plainTaskAnswer->id; ?>'); return false;" <?php if (!$mark) echo 'class="success"'; ?>
                                style="cursor: pointer">
                                <td><i class="fa <?php echo ($mark) ? ' fa-check' : ' fa-exclamation'; ?> fa-fw"></i>
                                </td>
                                <td class="center"></td>
                                <td class="center"><?= substr($plainTaskAnswer->plainTask->getDescription(), 0, 20) . '....'; ?></td>
                                <td class="center"><?php echo $plainTaskAnswer->getStudentName(); ?></td>
                                <td class="center">
                                    <?php echo $plainTaskAnswer->getShortDescription(); ?></td>
                                <td><?php if ($mark) {
                                        echo ($mark['mark']) ? "зарах." : "не зарах.";
                                    } ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php } else {
    echo "Нових задач немає.";
} ?>
<!-- DataTables JavaScript -->
<script
    src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
<script
    src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js'); ?>"></script>
<link type="text/css" rel="stylesheet" href="<?= StaticFilesHelper::fullPathTo('css', '_teacher/messages.css'); ?>"/>
<script>
    $(document).ready(function () {
        $('#tasksTable').DataTable({
                language: {
                    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                }
            }
        );
    });
</script>
