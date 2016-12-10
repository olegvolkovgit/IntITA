<?php
/**
 * @var $model Module
 * @var $teachers array
 * @var $item array
 * @var $scenario string
 */
?>
<div class="panel panel-default" ng-controller="moduleTeachersConsultantTableCtrl">
    <div class="panel-body">
        <?php if ($scenario == "update") { ?>
            <ul class="list-inline">
                <li>
                    <button type="button" class="btn btn-outline btn-primary" ng-click="changeView('module/addTeacherConsultant/<?= $model->module_ID ?>')">
                        Призначити викладача
                    </button>
                </li>
            </ul>
        <?php } ?>
        <div class="dataTable_wrapper">
            <table ng-table="moduleTeachersConsultantTable" class="table table-striped table-bordered table-hover">
                <tr ng-repeat="row in $data">
                    <td data-title="'Автор'" sortable="'user.fullName'" filter="{'user.fullName': 'text'}">
                        <a ng-href="#/admin/users/user/{{row.id_teacher}}" >
                            {{row.user.fullName}} ({{row.user.email}})
                        </a>
                    </td>
                    <td data-title="'Призначено'" sortable="'start_date'" filter="{start_date: 'text'}">{{row.start_date}}</td>
                    <td data-title="'Відмінено'" sortable="'end_date'" filter="{end_date: 'text'}" filter-data="lang">{{row.end_date}}</td>
                    <?php if ($scenario == 'update') { ?>
                        <td data-title="'Відмінити'">
                            <a ng-if="!row.end_date" href=""
                               ng-click="cancelTeacherRoleAttribute('teacher_consultant','module',row.id_teacher,row.id_module)">
                                скасувати
                            </a>
                        </td>
                    <?php } ?>
                </tr>
            </table>
        </div>
    </div>
</div>