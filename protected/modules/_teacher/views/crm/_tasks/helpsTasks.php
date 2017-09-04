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
                <tr ng-repeat="row in $data track by $index">
                    <td data-title="'Назва'" filter="{'idTask.name': 'text'}" sortable="'idTask.name'">
                        <a ng-href="" ng-click="getTask(row.idTask.id,'newTask')">{{row.idTask.name}}</a>
                    </td>
                    <td data-title="'Постановник'" filter="{'producerName.fullName': 'text'}" sortable="'producerName.fullName'">
                        {{row.producerName.fullName}}
                    </td>
                    <td data-title="'Дата'" filter="{'idTask.created_date': 'text'}" sortable="'idTask.created_date'">
                        {{row.idTask.created_date}}
                    </td>
                    <td data-title="'Статус'" filter="{'crmStates.id': 'select'}" filter-data="crmStateList">
                        {{row.idTask.taskState.description}}
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div ng-show="board==1">
        <div ng-include="getKanban()" ></div>
    </div>

</div>