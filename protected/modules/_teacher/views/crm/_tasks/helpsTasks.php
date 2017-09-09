<div class="panel panel-default" ng-controller="crmHelpsTasksCtrl">
    <div class="panel-body" ng-if="board==2">
        <div class="dataTable_wrapper">
            <table ng-table="tasksTableParams" class="table table-bordered table-striped table-condensed">
                <colgroup>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                </colgroup>
                <tr ng-repeat="row in $data track by $index"
                    ng-class="{'bg-warning-kanban': (row.idTask.id_state!=4 && row.idTask.endTask && currentDate>=(row.idTask.endTask  | shortDate:'yyyy-MM-dd')),
                    'bg-danger-kanban': (row.idTask.id_state!=4 && row.idTask.deadline && currentDate>(row.idTask.deadline  | shortDate:'yyyy-MM-dd'))}">
                    <td data-title="'Назва'" filter="{'idTask.name': 'text'}" sortable="'idTask.name'">
                        <a ng-href="" ng-click="getTask(row.idTask.id,'newTask')">{{row.idTask.name}}</a>
                    </td>
                    <td data-title="'Постановник'" filter="{'producerName.fullName': 'text'}" sortable="'producerName.fullName'">
                        {{row.producerName.fullName}}
                    </td>
                    <td data-title="'Виконавець'" filter="{'executantName.fullName': 'text'}" sortable="'executantName.fullName'">
                        {{row.executantName.fullName}}
                    </td>
                    <td data-title="'Дата'" filter="{'idTask.created_date': 'text'}" sortable="'idTask.created_date'">
                        {{row.idTask.created_date}}
                    </td>
                    <td data-title="'Статус'" filter="{'crmStates.id': 'select'}" filter-data="crmStateList"
                        ng-class="{'expect_to_execute': row.idTask.id_state == 1, 'executed': row.idTask.id_state == 2,
                        'completed': row.idTask.id_state == 4,'paused': row.idTask.id_state == 3}">
                        {{row.idTask.taskState.description}}
                        <div ng-if="row.idTask.id_state != 1 && roleId">
                            <em>{{row.lastChangeName?row.lastChangeName.fullName:''}}</em>
                            <div>Дата: <em>{{row.lastChangeName?row.lastStateHistory[0].change_date:''}}</em></div>
                        </div>
                    </td>
                    <td data-title="'Затрачений час'">
                        <p>{{row.spent_time | spentTime}}</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div ng-show="board==1">
        <div ng-include="getKanban()" ></div>
    </div>

</div>