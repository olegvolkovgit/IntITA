<?php
/**
 * @var $plainTaskAnswer PlainTaskAnswer
 * @var $teacherPlainTasks array
 * @var $mark boolean
 */
if (!empty($teacherPlainTasks)) { ?>
    <div class="col-lg-12" ng-controller="teacherConsultantTasksCtrl">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="tasksTable">
                        <thead>
                        <tr>
                            <th >Модуль(id)</th>
                            <th style="width: 15%">Лекція</th>
                            <th style="width: 20%">Задача</th>
                            <th style="width: 15%">Користувач</th>
                            <th>Відповідь</th>
                            <th style="width: 15%">Дата</th>
                            <th style="width: 10%">Оцінка</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($teacherPlainTasks as $plainTaskAnswer) {
                            $mark = $plainTaskAnswer->mark();?>
                            <tr ng-click="changeView('teacherConsultant/task/<?=$plainTaskAnswer->id ?>')"

                                <?php if (!$mark) echo 'class="success"'; ?>
                                style="cursor: pointer">
                                <td class="center">
                                    <?php echo $plainTaskAnswer->plainTask->lectureElement->lecture->module->title_ua.'('.$plainTaskAnswer->plainTask->lectureElement->lecture->module->module_ID.')' ?>
                                </td>
                                <td class="center"><?=$plainTaskAnswer->getLectureTitle()?$plainTaskAnswer->getLectureTitle():'Лекція видалена';?></td>
                                <td class="center"><?php echo strip_tags($plainTaskAnswer->plainTask->getDescription()); ?></td>
                                <td class="center"><?php echo $plainTaskAnswer->getStudentName(); ?></td>
                                <td class="center">
                                    <?php echo $plainTaskAnswer->answer; ?></td>
                                <td class="center">
                                    <?php echo date("d.m.Y",  strtotime($plainTaskAnswer->date)); ?></td>
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
    echo "Задач до перевірки немає.";
} ?>
