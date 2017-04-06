<div class="panel panel-default" ng-controller="offlineStudentsSVTableCtrl">
    <div class="panel-body">
        <a type="button" class="btn btn-primary" ng-href="#/supervisor/studentsWithoutGroup">Офлайн студенти(без групи)</a>
        <a ng-if="subgroup.id" type="button" class="btn btn-primary" ng-href="#/supervisor/addStudentToSubgroup/{{subgroup.id}}">Додати студента в підгрупу</a>
        <br>
        <br>
        <table ng-table="offlineStudentsTableParams" class="table table-bordered table-striped table-condensed">
            <tr ng-repeat="row in $data track by $index">
                <td data-title="'ПІБ'" filter="{'user.fullName': 'text'}" sortable="'user.fullName'">
                    <a ng-href="#/supervisor/userProfile/{{row.id_user}}">{{row.user.fullName}}</a>
                </td>
                <td data-title="'Email'" filter="{'user.email': 'text'}" sortable="'user.email'">
                    <a ng-href="#/supervisor/userProfile/{{row.id_user}}">{{row.user.email}}</a>
                </td>
                <td data-title="'Тренер'" filter="{'trainerData.fullName': 'text'}" sortable="'trainerData.fullName'">
                    <a ng-href="#/supervisor/userProfile/{{row.trainerData.id}}">{{row.trainerData.fullName}} {{row.trainerData.email}}</a>
                </td>
                <td data-title="'Навчальна зміна'" filter="{'user.education_shift': 'select'}" filter-data="shifts">
                    <span ng-if="row.user.education_shift==1">ранкова</span>
                    <span ng-if="row.user.education_shift==2">вечірня</span>
                    <span ng-if="row.user.education_shift==3">байдуже</span>
                </td>
                <td data-title="'Група'" filter="{'group.name': 'text'}" sortable="'group.name'">
                    <a ng-href="#/supervisor/offlineGroup/{{row.group.id}}">{{row.group.name}}</a>
                </td>
                <td data-title="'Підгрупа'" sortable="'subgroupName.name'" filter="{'subgroupName.name': 'text'}" >
                    <a ng-href="#/supervisor/offlineSubgroup/{{row.subgroupName.id}}">{{row.subgroupName.name}}</a>
                </td>
                <td data-title="'Додано'" sortable="'start_date'" filter="{'start_date': 'text'}">
                    {{row.start_date}}
                </td>
                <td data-title="'Випуск'" sortable="'graduate_date'" filter="{'graduate_date': 'text'}">
                    {{row.graduate_date}}
                </td>
                <td style="word-wrap:break-word;" data-title="'Телефон'" sortable="'user.phone'" filter="{'user.phone': 'text'}">
                    {{row.user.phone}}
                </td>
            </tr>
        </table>
    </div>
</div>