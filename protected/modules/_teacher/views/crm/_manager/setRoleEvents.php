<div class="panel panel-default">
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table ng-table="setRoleEventsTableParams" class="table table-bordered table-striped table-condensed">
                <colgroup>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                </colgroup>
                <tr ng-repeat="row in $data track by $index">
                    <td data-title="'Користувач'" filter="{'assignedBy.fullName': 'text'}" sortable="assignedBy.fullName">
                        <a ng-href="#/users/profile/{{row.assigned_by}}" target="_blank">{{row.assignedBy.fullName}}</a>
                    </td>
                    <td data-title="'Призначив/скасував роль'" filter="{'role0.description': 'text'}">
                        {{!row.cancelled_date?' призначив тобі роль ':' скасував у тебе роль '}}
                        "<b><em>{{row.role0.description}}</em></b>"
                    </td>
                    <td data-title="'Завдання'" filter="{'idTask.name': 'text'}" sortable="'idTask.name'">
                        <a ng-href="" ng-click="getTask(row.idTask.id)">{{row.idTask.name}}</a>
                        <div class="svgContainer pull-right">
                            <a ng-href="#task/{{row.idTask.id}}" target="_blank">
                                <div class="openIco" ng-include="pathToCrmTemplates+'/svg/new_window.svg'" title="Відкрити в новому вікні" ></div>
                            </a>
                        </div>
                    </td>
                    <td data-title="'Дата'" filter="{'assigned_date': 'text'}" sortable="'assigned_date'">
                        {{row.cancelled_date?row.cancelled_date:row.assigned_date}}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>