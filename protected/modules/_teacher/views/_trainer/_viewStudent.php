<?php
/**
 * @var $student RegisteredUser
 * @var $modules array
 * @var $teachersByModule array
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
                                        <a  href="" ng-click="isCollapsed<?php echo $key ?> = !isCollapsed<?php echo $key ?>">
                                            <?= CHtml::encode($course["title"] . " (" . $course["lang"] . ")"); ?>
                                        </a>
                                    </h4>
                                </div>
                                <div uib-collapse="!isCollapsed<?php echo $key ?>" class="panel-collapse collapse">
                                    <ul>
                                        <?php
                                        $courseModules = CourseModules::modulesInfoByCourse($course["id"]);
                                        if(count($courseModules) > 0) {
                                            foreach ($courseModules as $record) { ?>
                                                <li>
                                                    <a href="javascript:void(0)" ng-click="changeView('trainer/changeTeacher/modude/<?=$record["id"]?>/student/<?=$student->id?>')"
                                                       >
                                                        <?= $record["title"] . " (" . $record["lang"] . ")";
                                                        if (isset($teachersByModule[$record["id"]])) {
                                                            ?>
                                                            <em>(викладач - <?= $teachersByModule[$record["id"]]; ?>)</em>
                                                        <?php } else { ?>
                                                            <span class="warningMessage"><em>викладача не призначено</em></span>
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
                                <a href="javascript:void(0)" ng-click="changeView('trainer/changeTeacher/modude/<?=$module["id"]?>/student/<?=$student->id?>')"
                                   >
                                    <?= $module["title"] . " (" . $module["lang"] . ")";
                                    if (isset($teachersByModule[$module["id"]])) {
                                        ?>
                                        <em>(викладач - <?= $teachersByModule[$module["id"]]; ?>)</em>
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
