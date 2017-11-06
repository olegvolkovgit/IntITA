<div class="panel panel-default">
    <div class="panel-body">
        <table ng-table="groupModulesAccessParams" class="table table-bordered table-striped table-condensed">
            <tr ng-repeat="row in $data track by $index">
                <td data-title="'Модуль'" filter="{'module.title_ua': 'text'}" sortable="'module.title_ua'">
                    <a href="" ng-click="moduleLink(row.module.module_ID)">{{row.module.title_ua}}</a>
                </td>
                <td data-title="'Закінчення доступу'" sortable="'end_date'" filter="{'end_date': 'text'}">
                    {{row.end_date}}
                </td>
            </tr>
        </table>
    </div>
</div>