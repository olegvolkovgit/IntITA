<?php
/**
 * @var $students array
 * @var $student StudentReg
 */
?>
<div class="row" ng-controller="teacherConsultantStudentsCtrl">
    <h4>Групи студентів:</h4>
    <ul class="list-group">
        <li ng-repeat="group in studentsCategory track by $index" class="list-group-item">
            <div class="panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a href="" data-toggle="collapse" ng-click="showStudents(group)">
                            {{group.title}}
                        </a>
                    </h4>
                </div>
                <div id="collapse{{group.id}}" class="panel-collapse collapse">
                    <ul>
                        <li ng-repeat="student in group.students track by $index">
                            <a ng-href="#/users/profile/{{student.id}}">
                                {{student.firstName}} {{student.secondName}} {{student.email}}
                            </a>
                            Модуль:
                            <a href="" ng-click="moduleLink(student.module_ID)">
                                {{student.title_ua}} ({{student.language}})
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </li>
    </ul>
</div>