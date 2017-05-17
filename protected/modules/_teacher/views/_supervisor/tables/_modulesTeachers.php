<div class="row" ng-controller="groupModulesAttributesCtrl" >
    <table class="table table-hover">
        <tbody>
        <tr>
            <td width="20%">Курси:</td>
            <td>
                <div ng-repeat="course in courses track by $index" class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a  href="" ng-click="course.isCollapsed = !course.isCollapsed">
                                    {{course.course.title_ua}} ({{course.course.language}})
                                </a>
                            </h4>
                        </div>
                        <div uib-collapse="!course.isCollapsed" class="panel-collapse collapse">
                            <ul>
                                <li ng-repeat="module in course.course.module track by $index">
                                    <a ng-href="#/supervisor/changeModuleTeacher/module/{{module.id_module}}/group/{{course.group_id}}" >
                                        {{module.moduleInCourse.title_ua}} ({{module.moduleInCourse.language}})
                                        <em ng-if="module.groupModuleTeacher.teacher">
                                            (викладач -
                                            {{module.groupModuleTeacher.teacher.firstName}}
                                            {{module.groupModuleTeacher.teacher.lastName}}
                                            {{module.groupModuleTeacher.teacher.email}})
                                        </em>
                                        <span ng-if="!module.groupModuleTeacher.teacher" class="warningMessage"><em>викладача не призначено</em></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td width="20%">Модулі:</td>
            <td>
                <ul>
                    <li ng-repeat="module in modules track by $index">
                        <a ng-href="#/supervisor/changeModuleTeacher/module/{{module.module.module_ID}}/group/{{module.group_id}}" >
                            {{module.module.title_ua}} ({{module.module.language}})
                            <em ng-if="module.groupModuleTeacher.teacher">
                                (викладач -
                                {{module.groupModuleTeacher.teacher.firstName}}
                                {{module.groupModuleTeacher.teacher.lastName}}
                                {{module.groupModuleTeacher.teacher.email}})
                            </em>
                            <span ng-if="!module.groupModuleTeacher.teacher" class="warningMessage"><em>викладача не призначено</em></span>
                        </a>
                    </li>
                </ul>
            </td>
        </tr>
        </tbody>
    </table>
</div>