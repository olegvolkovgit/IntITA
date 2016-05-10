<?php
/**
 * @var $student RegisteredUser
 */
$modules = $student->getAttributesByRole(UserRoles::STUDENT)[0]["value"];
$courses = $student->getAttributesByRole(UserRoles::STUDENT)[1]["value"];
?>
<div class="row">
    <table class="table table-hover">
        <tbody>
        <tr>
            <td width="20%">Профіль:</td>
            <td>
                <a href="<?= Yii::app()->createUrl("studentreg/profile", array("idUser" => $student->registrationData->id)); ?>"
                   target="_blank">
                    Профіль студента
                </a>
            </td>
        </tr>
        <tr>
            <td width="20%">Курси:</td>
            <td>
                <?php if (!empty($courses)) { ?>
                    <?php foreach ($courses as $course) {
                        ?>
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#collapse<?= $course["id"] ?>">
                                            <?= $course["title"] . " (" . $course["lang"] . ")"; ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse<?= $course["id"] ?>" class="panel-collapse collapse">
                                    <ul>
                                        <?php
                                        $courseModules = CourseModules::modulesWithStudentTeacher($course["id"], $student->id);
                                        if(count($courseModules) > 0) {
                                            foreach ($courseModules as $record) { ?>
                                                <li>
                                                    <a href="#"
                                                       onclick="load('<?= Yii::app()->createUrl("/_teacher/_trainer/trainer/editTeacherModule",
                                                           array("id" => $student->id, "idModule" => $record["id"])); ?>',
                                                           '<?= $student->registrationData->userName(); ?>');">
                                                        <?= $record["title"] . " (" . $record["lang"] . ")";
                                                        if (is_null($record["end_date"]) && $record["teacherId"]) {
                                                            ?>
                                                            <em>(викладач - <?= $record["teacherName"] ?>)</em>
                                                        <?php } else { ?>
                                                            <span class="warningMessage"><em>викладача не
                                                                    призначено</em></span>
                                                        <?php } ?>
                                                    </a>
                                                </li>
                                            <?php }
                                        } else {
                                            echo "Модулів у даному курсі ще немає.";
                                        }?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                <?php } else { ?>
                    <em>Курсів немає.</em>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td width="20%">Модулі:</td>
            <td>
                <?php if (!empty($modules)) { ?>
                    <ul>
                        <?php foreach ($modules as $module) {
                            ?>
                            <li>
                                <a href="#"
                                   onclick="load('<?= Yii::app()->createUrl("/_teacher/_trainer/trainer/editTeacherModule",
                                       array("id" => $student->id, "idModule" => $module["id"])); ?>',
                                       '<?= $student->registrationData->userName(); ?>');">
                                    <?= $module["title"] . " (" . $module["lang"] . ")";
                                    if (is_null($module["end_date"]) && $module["teacherId"]) {
                                        ?>
                                        <em>(викладач - <?= $module["teacherName"] ?>)</em>
                                    <?php } else { ?>
                                        <span class="warningMessage"><em>викладача не призначено</em></span>
                                    <?php } ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } else { ?>
                    <em>Модулів немає.</em>
                <?php } ?>
            </td>
        </tr>
        </tbody>
    </table>
</div>
