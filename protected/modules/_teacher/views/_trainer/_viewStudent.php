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
            <td width="30%">Профіль:</td>
            <td>
                <a href="<?= Yii::app()->createUrl("studentreg/profile", array("idUser" => $student->registrationData->id)); ?>"
                   target="_blank">
                    Профіль студента
                </a>
            </td>
        </tr>
        <tr>
            <td width="30%">Курси:</td>
            <td>
                <?php if (!empty($courses)) { ?>
                    <ul>
                        <?php foreach ($courses as $course) {
                            ?>
                            <li>
                                <a href="<?= Yii::app()->createUrl("course/index", array("id" => $course["id"])); ?>"
                                   target="_blank">
                                    <?=$course["title"]." (".$course["lang"].")";?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td width="30%">Модулі:</td>
            <td>
                <?php if (!empty($modules)) { ?>
                    <ul>
                        <?php foreach ($modules as $module) {
                            ?>
                            <li>
                                <a href="<?= Yii::app()->createUrl("module/index", array("idModule" => $module["id"])); ?>"
                                   target="_blank">
                                    <?=$module["title"]." (".$module["lang"].")";?>
                                </a>

                                <a href="#" onclick="load('<?= Yii::app()->createUrl("/_teacher/_trainer/trainer/editTeacher",
                                    array("id" => $student->id, "idModule" => $module["id"])); ?>',
                                    '<?= $student->registrationData->userName(); ?>');">викладач</a
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </td>
        </tr>
        </tbody>
    </table>
</div>
