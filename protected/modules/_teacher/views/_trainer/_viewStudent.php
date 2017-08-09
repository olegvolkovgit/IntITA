<?php
/**
 * @var $student RegisteredUser
 * @var $modules array
 * @var $teachersByModule array
 */
$organization=Yii::app()->user->model->getCurrentOrganization()->id;
$modules = $student->getAttributesByRole(UserRoles::STUDENT,$organization)[0]["value"];
$courses = $student->getAttributesByRole(UserRoles::STUDENT,$organization)[1]["value"];
?>
*Тренер закріплює студенту викладача по конкретному модулю, який доступний студенту
<div class="row" ng-controller="trainersStudentViewCtrl" ng-init="changePageHeader('Студент: <?php echo $student->registrationData->fullName() ?>')">
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
                    <?php foreach ($courses as $key=>$course) {
                        ?>
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a  href="" ng-click="isCollapsed<?php echo $key ?> = !isCollapsed<?php echo $key ?>">
                                            <?= CHtml::encode($course["title_ua"] . " (" . $course["lang"] . ")"); ?>
                                        </a>
                                        <?php if($course['rating']>0){ ?>
                                            <span style="color: green">Завершено! <?php echo (round($course['rating']*10,2)).'/10' ?></span>
                                        <?php } ?>
                                    </h4>
                                </div>
                                <div uib-collapse="!isCollapsed<?php echo $key ?>" class="panel-collapse collapse">
                                    <ul>
                                        <?php
                                        $courseModules = CourseModules::modulesInfoByCourse($course["id"], $student->registrationData->id);
                                        if(count($courseModules) > 0) {
                                            foreach ($courseModules as $record) { ?>
                                                <li>
                                                    <a href="javascript:void(0)" ng-click="changeView('trainer/changeTeacher/modude/<?=$record["id"]?>/student/<?=$student->id?>')"
                                                       >
                                                        <?= $record["title"] . " (" . $record["lang"] . ")";
                                                        if (isset($teachersByModule[$record["id"]])) {
                                                            ?>
                                                            <em>
                                                                (викладач - <?= $teachersByModule[$record["id"]]['name']; ?>)
                                                                <a class="btnChat"  ng-href="#/newmessages/receiver/<?php echo   $teachersByModule[$record["id"]]['id'] ?>"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">
                                                                    <i class="fa fa-envelope fa-fw"></i>
                                                                </a>
                                                                <a class="btnChat" href="<?php echo Config::getChatPath(); ?><?php echo $teachersByModule[$record["id"]]['id'] ?>" target="_blank" data-toggle="tooltip" data-placement="left" title="Чат">
                                                                    <i class="fa fa-weixin fa-fw"></i>
                                                                </a>
                                                            </em>
                                                        <?php } else { ?>
                                                            <span class="warningMessage"><em>викладача не призначено</em></span>
                                                        <?php } ?>
                                                        <?php if($record['rating']>0){ ?>
                                                            <span style="color: green">Завершено! <?php echo (round($record['rating']*10,2)).'/10' ?></span>
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
                                    <?= $module["title_ua"] . " (" . $module["lang"] . ")";
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
                                    <?php if($module['rating']>0){ ?>
                                        <span style="color: green">Завершено! <?php echo (round($module['rating']*10,2)).'/10' ?></span>
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
