<div class="panel panel-default">
    <div class="panel-body">
        <table ng-table="studentsWithoutGroupTableParams" class="table table-bordered table-striped table-condensed">
            <tr ng-repeat="row in $data track by row.id">
                <td data-title="'ПІБ'" filter="{'fullName': 'text'}" sortable="'fullName'">
                    <a ng-href="#/supervisor/studentProfile/{{row.id}}">{{row.fullName}}</a>
                </td>
                <td data-title="'Email'" filter="{'email': 'text'}" sortable="'email'">
                    <a ng-href="#/supervisor/studentProfile/{{row.id}}">{{row.email}}</a>
                </td>
                <td data-title="'Тренер'" sortable="'trainer.trainer'">
                    {{row.trainer.trainer ? 'присутній':''}}
                </td>
            </tr>
        </table>
    </div>
</div>