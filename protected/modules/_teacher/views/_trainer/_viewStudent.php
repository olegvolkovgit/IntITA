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
                    <ul>
                        <?php foreach ($courses as $course) {
                            ?>
                            <li>
                                <a href="#"
                                   onclick="load('<?= Yii::app()->createUrl("/_teacher/_trainer/trainer/editTeacherCourse",
                                       array("id" => $student->id, "idCourse" => $course["id"])); ?>',
                                       '<?= $student->registrationData->userNameWithEmail(); ?>');">
                                    <?= $course["title"] . " (" . $course["lang"] . ")"; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
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
                                        if($module["teacherName"] != ""){?>
                                        <em>(викладач - <?= $module["teacherName"] ?>)</em>
                                    <?php } else {?>
                                            <span class="warningMessage"><em>викладача не призначено</em></span>
                                    <?php }?>
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
