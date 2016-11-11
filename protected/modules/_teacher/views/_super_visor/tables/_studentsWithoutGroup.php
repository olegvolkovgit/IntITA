<div class="panel panel-default">
    <div class="panel-body">
        <table ng-table="studentsWithoutGroupTableParams" class="table table-bordered table-striped table-condensed">
            <tr ng-repeat="row in $data track by row.id">
                <td data-title="'ПІБ'" filter="{'fullName': 'text'}" sortable="'fullName'">
                    <a ng-href="#/supervisor/userProfile/{{row.id}}">{{row.fullName}}</a>
                </td>
                <td data-title="'Email'" filter="{'email': 'text'}" sortable="'email'">
                    <a ng-href="#/supervisor/userProfile/{{row.id}}">{{row.email}}</a>
                </td>
                <td data-title="'Тренер'" filter="{'trainerData.fullName': 'text'}" sortable="'trainerData.fullName'">
                    <a ng-href="#/supervisor/userProfile/{{row.trainerData.id}}">{{row.trainerData.fullName}} {{row.trainerData.email}}</a>
                </td>
                <td data-title="'Телефон'" sortable="'phone'" filter="{'phone': 'text'}">
                    {{row.phone}}
                </td>
                <td data-title="">
                    <a ng-href="#/supervisor/addStudentToSubgroup/{{row.id}}">Додати в підгрупу</a>
                </td>
            </tr>
        </table>
    </div>
</div>