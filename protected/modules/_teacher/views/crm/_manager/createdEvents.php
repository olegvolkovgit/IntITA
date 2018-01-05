<div class="panel panel-default">
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table ng-table="createdEventsTableParams" class="table table-bordered table-striped table-condensed">
                <colgroup>
                    <col width="70px"/>
                    <col/>
                    <col/>
                    <col/>
                </colgroup>
                <tr ng-repeat="row in $data track by $index">
                    <td data-title="'id'" filter="{'id': 'text'}" sortable="'id'">
                        {{row.id}}
                    </td>
                    <td data-title="'Назва'" filter="{'name': 'text'}" sortable="'name'">
                        <a ng-href="" ng-click="getTask(row.id)">{{row.name}}</a>
                        <div class="col-md-12 svgContainer">
                            <div class="openIco" ng-include="pathToCrmTemplates+'/svg/windows.svg'" title="Відкрити" ng-click="getTask(row.id)"></div>
                            <a ng-href="#task/{{row.id}}" target="_blank">
                                <div class="openIco" ng-include="pathToCrmTemplates+'/svg/new_window.svg'" title="Відкрити в новому вікні" ></div>
                            </a>
                        </div>
                    </td>
                    <td data-title="'Створив'" filter="{'createdBy.fullName': 'select'}" filter-data="createdBy.fullName">
                        {{row.createdBy.fullName}}
                    </td>
                    <td data-title="'Дата'" filter="{'created_date': 'text'}" sortable="'created_date'">
                        {{row.created_date}}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>