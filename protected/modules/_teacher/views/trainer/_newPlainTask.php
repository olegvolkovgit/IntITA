<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 09.12.2015
 * Time: 16:54
 *
 * @var $plainTasksAnswers PlainTaskAnswer
 * @var $module Module
 */
if (!empty($plainTasksAnswers)) {
    ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-bordered table-hover" id="newTasksTable">
                    <thead>
                    <tr>
                        <th>Номер задачі</th>
                        <th>Студент</th>
                        <th>Відповідь</th>
                        <th>Модуль</th>
                        <th>Призначити консультанта</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($plainTasksAnswers as $plainTaskAnswer) {
                        $module = $plainTaskAnswer->getModule();
                        if ($module) {
                            ?>
                            <tr>
                                <td><?php echo $plainTaskAnswer->id; ?></td>
                                <td><?php echo $plainTaskAnswer->getStudentName(); ?></td>
                                <td><?php echo $plainTaskAnswer->answer; ?></td>
                                <td><?php echo $module->title_ua; ?></td>
                                <td>
                                    <a href="#" onclick="chooseTrainer('<?php echo $plainTaskAnswer->id ?>',
                                        '<?php echo Yii::app()->createUrl("_teacher/teacher/addConsultant") ?>')">
                                        <img style="padding-left: 50px"
                                             src="<?php echo StaticFilesHelper::createPath('image', 'editor', 'add.png') ?>"
                                    </a>
                                </td>
                            </tr>
                        <?php }
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
} else echo '<br>Наразі для всіх задач призначені консультанти.'; ?>
<script>
    $jq(document).ready(function () {
        $jq('#newTasksTable').DataTable({
                "autoWidth": false,
                language: {
                    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                }
            }
        );
    });
</script>


