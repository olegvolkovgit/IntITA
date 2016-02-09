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
                <table class="table table-striped table-bordered table-hover" id="newTasksTable">
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
                                <td><?php echo substr($plainTaskAnswer->answer, 0, 25) . '...'; ?></td>
                                <td><?php echo $module->title_ua; ?></td>
                                <td>
                                    <a href="javascript:chooseTrainer('<?php echo $plainTaskAnswer->id ?>',
                    '<?php echo Yii::app()->createUrl('_teacher/teacher/addConsultant') ?>')" target="_blank">
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
} else echo 'Наразі всі задачі з консультантами'; ?>


