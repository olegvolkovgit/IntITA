<div class="panel panel-default" ng-controller="studentsWithoutGroupSVTableCtrl">
    <div class="panel-body">
        <table ng-table="studentsWithoutGroupTableParams" class="table table-bordered table-striped table-condensed">
            <colgroup>
                <col/>
                <col/>
                <col width="10%"/>
                <col/>
                <col width="10%"/>
            </colgroup>
            <tr ng-repeat="row in $data track by row.id">
                <td style="word-wrap:break-word" data-title="'Студент'" filter="{'fullName': 'text'}" sortable="'fullName'">
                    <a ng-href="#/users/profile/{{row.id}}">{{row.fullName}}</a>
                </td>
                <td data-title="'Тренер'" filter="{'trainerData.fullName': 'text'}" sortable="'trainerData.fullName'">
                    <a ng-href="#/users/profile/{{row.trainerData.id}}">{{row.trainerData.fullName}} {{row.trainerData.email}}</a>
                </td>
                <td data-title="'Навчальна зміна'" filter="{'education_shift': 'select'}" filter-data="shifts">
                    <span ng-if="row.education_shift==1">ранкова</span>
                    <span ng-if="row.education_shift==2">вечірня</span>
                    <span ng-if="row.education_shift==3">байдуже</span>
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