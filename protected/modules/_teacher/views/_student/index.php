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
            <td width="20%">Курси:</td>
            <td>
                <?php if (!empty($courses)) { ?>
                    <ul>
                        <?php foreach ($courses as $course) {
                        if(!$course["cancelled"]){?>
                            <li>
                                <a href="<?= Yii::app()->createUrl("course/index", array("id" => $course["id"])); ?>"
                                   target="_blank">
                                    <?= CHtml::encode($course["title_ua"]." (".$course["lang"].")");?>
                                </a>
                            </li>
                        <?php } else {?>
                            <li>
                                <?= CHtml::encode($course["title_ua"]." (".$course["lang"].") - скасований");?>
                            </li>
                        <?php }
                        } ?>
                    </ul>
                <?php } else {
                    echo "Немає доступних курсів.";
                }?>
            </td>
        </tr>
        <tr>
            <td width="20%">Модулі:</td>
            <td>
                <?php if (!empty($modules)) { ?>
                    <ul>
                        <?php foreach ($modules as $module) {
                            if(!$module["cancelled"]){?>
                                <li>
                                    <a href="<?= Yii::app()->createUrl("module/index", array("idModule" => $module["id"])); ?>"
                                       target="_blank">
                                        <?=$module["title_ua"]." (".$module["lang"].")";?>
                                    </a>
                                    <?php
                                    if (isset($teachersByModule[$module["id"]])) {
                                        ?>
                                        <em>(викладач - <?= $teachersByModule[$module["id"]]; ?>)</em>
                                    <?php } else { ?>
                                        <span class="warningMessage"><em>викладача не призначено</em></span>
                                    <?php } ?>
                                </li>
                            <?php } else {?>
                                <li>
                                    <?=$module["title_ua"]." (".$module["lang"].") - скасований";?>
                                </li>
                        <?php }
                        } ?>
                    </ul>
                <?php } else {
                    echo "Немає доступних модулів.";
                }?>
            </td>
        </tr>
        </tbody>
    </table>
</div>
