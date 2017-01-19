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
                <td data-title="'Навчальна зміна'" filter="{'education_shift': 'select'}" filter-data="shifts">
                    <span ng-if="row.education_shift==1">ранкова</span>
                    <span ng-if="row.education_shift==2">вечірня</span>
                    <span ng-if="row.education_shift==3">байдуже</span>
                    <button ng-if="row.education_shift!=2" type="button" class="btn btn-outline btn-primary btn-xs" ng-click="changeStudentShift(row.id,2);">
                        змінити на вечірню
                    </button>
                    <button ng-if="row.education_shift!=1" type="button" class="btn btn-outline btn-primary btn-xs" ng-click="changeStudentShift(row.id,1);">
                        змінити на ранкову
                    </button>
                </td>
                <td data-title="'Телефон'" sortable="'phone'" filter="{'phone': 'text'}">
                    {{row.phone}}
                </td>
                <td data-title="">
                    <a ng-href="#/supervisor/addOfflineStudent/{{row.id}}">Додати в підгрупу</a>
                </td>
            </tr>
        </table>
    </div>
</div>