<div class="panel panel-default">
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table ng-table="updatedEventsTableParams" class="table table-bordered table-striped table-condensed">
                <colgroup>
                    <col/>
                    <col/>
                    <col/>
                </colgroup>
                <tr ng-repeat="row in $data track by $index">
                    <td data-title="'Завдання'" filter="{'name': 'text'}" sortable="'name'">
                        <a ng-href="" ng-click="getTask(row.id)">{{row.name}}</a>
                        <div class="svgContainer pull-right">
                            <a ng-href="#task/{{row.id}}" target="_blank">
                                <div class="openIco" ng-include="pathToCrmTemplates+'/svg/new_window.svg'" title="Відкрити в новому вікні" ></div>
                            </a>
                        </div>
                    </td>
                    <td data-title="'Відредаговано'" filter="{'changedBy.fullName': 'text'}" sortable="changedBy.fullName">
                        <a ng-href="#/users/profile/{{row.changed_by}}" target="_blank">{{row.changedBy.fullName}}</a>
                    </td>
                    <td data-title="'Дата'" filter="{'change_date': 'text'}" sortable="'change_date'">
                        {{row.change_date}}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>