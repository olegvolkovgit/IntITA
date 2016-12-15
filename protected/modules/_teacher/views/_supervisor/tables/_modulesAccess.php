<div class="panel panel-default">
    <div class="panel-body">
        <a type="button" class="btn btn-primary" ng-href="#/supervisor/groupAccess/module/group/{{groupId}}">
            Додати доступ до модуля
        </a>
        <br>
        <br>
        <table ng-table="groupModulesAccessParams" class="table table-bordered table-striped table-condensed">
            <tr ng-repeat="row in $data track by $index">
                <td data-title="'Модуль'" filter="{'module.title_ua': 'text'}" sortable="'module.title_ua'">
                    <a href="" ng-click="moduleLink(row.module.module_ID)">{{row.module.title_ua}}</a>
                </td>
<!--                <td data-title="'Початок доступу'" sortable="'start_date'" filter="{'start_date': 'text'}">-->
<!--                    {{row.start_date}}-->
<!--                </td>-->
                <td data-title="'Закінчення доступу'" sortable="'end_date'" filter="{'end_date': 'text'}">
                    {{row.end_date}}
                </td>
                <td data-title="'Скасувати доступ'">
                    <a href="" ng-if="row.end_date > date" ng-click="cancelGroupAccess(row.group_id, row.service_id, 'module')">
                        <i class="fa fa-trash fa-fw"></i>
                    </a>
                </td>
                <td data-title="'Редагувати'">
                    <a ng-href="#/supervisor/editGroupAccess/module/group/{{row.group_id}}/service/{{row.service_id}}">
                        редагувати
                    </a>
                </td>
            </tr>
        </table>
    </div>
</div>