<?php
/**
 * @var $student RegisteredUser
 * @var $modules array
 * @var $teachersByModule array
 */
$student = RegisteredUser::userById(38);
$modules = $student->getAttributesByRole(UserRoles::STUDENT)[0]["value"];
$courses = $student->getAttributesByRole(UserRoles::STUDENT)[1]["value"];
?>
<div class="panel panel-default">
    <div class="panel-body" style="padding:15px 0 0 0" >
        <ul class="list-group" >
<!--            <li class="list-group-item">-->
<!--                <label>Викладачі в групі:</label>-->
<!--                <div class="row">-->
<!--                    <table class="table table-hover">-->
<!--                        <tbody>-->
<!--                        <tr>-->
<!--                            <td width="20%">Курси:</td>-->
<!--                            <td>-->
<!--                                --><?php //if (!empty($courses)) { ?>
<!--                                    --><?php //foreach ($courses as $course) {
//                                        ?>
<!--                                        <div class="panel-group">-->
<!--                                            <div class="panel panel-default">-->
<!--                                                <div class="panel-heading">-->
<!--                                                    <h4 class="panel-title">-->
<!--                                                        <a  ng-click="isCollapsed = !isCollapsed">-->
<!--                                                            --><?//= $course["title"] . " (" . $course["lang"] . ")"; ?>
<!--                                                        </a>-->
<!--                                                    </h4>-->
<!--                                                </div>-->
<!--                                                <div uib-collapse="!isCollapsed" class="panel-collapse collapse">-->
<!--                                                    <ul>-->
<!--                                                        --><?php
//                                                        $courseModules = CourseModules::modulesInfoByCourse($course["id"]);
//                                                        if(count($courseModules) > 0) {
//                                                            foreach ($courseModules as $record) { ?>
<!--                                                                <li>-->
<!--                                                                    <a href="javascript:void(0)" ng-click="changeView('trainer/changeTeacher/modude/--><?//=$record["id"]?><!--/student/--><?//=$student->id?><!--')"-->
<!--                                                                    >-->
<!--                                                                        --><?//= $record["title"] . " (" . $record["lang"] . ")";
//                                                                        if (isset($teachersByModule[$record["id"]])) {
//                                                                            ?>
<!--                                                                            <em>(викладач - --><?//= $teachersByModule[$record["id"]]; ?><!--)</em>-->
<!--                                                                        --><?php //} else { ?>
<!--                                                                            <span class="warningMessage"><em>викладача не призначено</em></span>-->
<!--                                                                        --><?php //} ?>
<!--                                                                    </a>-->
<!--                                                                </li>-->
<!--                                                            --><?php //}
//                                                        } else {
//                                                            echo "Модулів у даному курсі ще немає.";
//                                                        }?>
<!--                                                    </ul>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    --><?php //} ?>
<!--                                --><?php //} else { ?>
<!--                                    <em>Курсів немає.</em>-->
<!--                                --><?php //} ?>
<!--                            </td>-->
<!--                        </tr>-->
<!--                        <tr>-->
<!--                            <td width="20%">Модулі:</td>-->
<!--                            <td>-->
<!--                                --><?php //if (!empty($modules)) { ?>
<!--                                    <ul>-->
<!--                                        --><?php //foreach ($modules as $module) {
//                                            ?>
<!--                                            <li>-->
<!--                                                <a href="javascript:void(0)" ng-click="changeView('trainer/changeTeacher/modude/--><?//=$module["id"]?><!--/student/--><?//=$student->id?><!--')"-->
<!--                                                >-->
<!--                                                    --><?//= $module["title"] . " (" . $module["lang"] . ")";
//                                                    if (isset($teachersByModule[$module["id"]])) {
//                                                        ?>
<!--                                                        <em>(викладач - --><?//= $teachersByModule[$module["id"]]; ?><!--)</em>-->
<!--                                                    --><?php //} else { ?>
<!--                                                        <span class="warningMessage"><em>викладача не призначено</em></span>-->
<!--                                                    --><?php //} ?>
<!--                                                </a>-->
<!--                                            </li>-->
<!--                                        --><?php //} ?>
<!--                                    </ul>-->
<!--                                --><?php //} else { ?>
<!--                                    <em>Модулів немає.</em>-->
<!--                                --><?php //} ?>
<!--                            </td>-->
<!--                        </tr>-->
<!--                        </tbody>-->
<!--                    </table>-->
<!--                </div>-->
<!--            </li>-->
        </ul>
    </div>
</div>

