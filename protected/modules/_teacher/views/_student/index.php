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
                    <?php foreach ($courses as $key=>$course) { ?>
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a  href="" ng-click="isCollapsed<?php echo $key ?> = !isCollapsed<?php echo $key ?>">
                                            <?= CHtml::encode($course["title_ua"] . " (" . $course["lang"] . ")"); ?>
                                        </a>
                                    </h4>
                                </div>
                                <div uib-collapse="!isCollapsed<?php echo $key ?>" class="panel-collapse collapse">
                                    <ul>
                                        <?php
                                        $courseModules = CourseModules::modulesInfoByCourse($course["id"]);
                                        if(count($courseModules) > 0) {
                                            foreach ($courseModules as $record) {
                                                if (!$record["cancelled"]) { ?>
                                                    <li>
                                                        <a href="<?= Yii::app()->createUrl("module/index", array("idModule" => $record["id"])); ?>"
                                                           target="_blank">
                                                            <?= $record["title"] . " (" . $record["lang"] . ")"; ?>
                                                        </a>
                                                        <?php
                                                        if (isset($teachersByModule[$record["id"]]['name'])) {
                                                            ?>
                                                            <em>
                                                                (викладач - <?= $teachersByModule[$record["id"]]['name']; ?>)
                                                                <a class="btnChat"  ng-href="#/newmessages/receiver/<?php echo $teachersByModule[$record["id"]]['id'] ?>"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">
                                                                    <i class="fa fa-envelope fa-fw"></i>
                                                                </a>
                                                                <a class="btnChat" href="<?php echo Config::getChatPath(); ?><?php echo $teachersByModule[$record["id"]]['id'] ?>" target="_blank" data-toggle="tooltip" data-placement="left" title="Чат">
                                                                    <i class="fa fa-weixin fa-fw"></i>
                                                                </a>
                                                            </em>
                                                        <?php } else { ?>
                                                            <span class="warningMessage"><em>викладача не призначено</em></span>
                                                        <?php } ?>
                                                    </li>
                                                <?php } else { ?>
                                                    <li>
                                                        <?= $record["title"] . " (" . $record["lang"] . ") - скасований"; ?>
                                                    </li>
                                                <?php }
                                            }
                                        }?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
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
                                        <em>
                                            (викладач - <?= $teachersByModule[$module["id"]]['name']; ?>)
                                            <a class="btnChat"  ng-href="#/newmessages/receiver/<?php echo $teachersByModule[$module["id"]]['id'] ?>"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">
                                                <i class="fa fa-envelope fa-fw"></i>
                                            </a>
                                            <a class="btnChat" href="<?php echo Config::getChatPath(); ?><?php echo $teachersByModule[$module["id"]]['id'] ?>" target="_blank" data-toggle="tooltip" data-placement="left" title="Чат">
                                                <i class="fa fa-weixin fa-fw"></i>
                                            </a>
                                        </em>
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
