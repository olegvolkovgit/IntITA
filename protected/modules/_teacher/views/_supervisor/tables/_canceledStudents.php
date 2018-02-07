<div class="panel panel-default">
    <div class="panel-body">
        <a type="button" class="btn btn-primary" ng-href="#/supervisor/studentsWithoutGroup">Офлайн студенти(без групи)</a>
        <a ng-if="subgroup.id" type="button" class="btn btn-primary" ng-href="#/supervisor/addStudentToSubgroup/{{subgroup.id}}">Додати студента в підгрупу</a>
        <br>
        <br>
        <table ng-table="offlineCanceledStudentsTableParams" class="table table-bordered table-striped table-condensed">
            <colgroup>
                <col width="20%"/>
                <col/>
                <col width="10%"/>
                <col width="10%"/>
                <col/>
                <col width="10%"/>
                <col width="10%"/>
                <col/>
            </colgroup>
<!--            ng-if="$data[$index].end_date!=null && $data[$index].id_subgroup==subgroup.id"-->
            <tr ng-repeat="row in $data track by $index">
                <td style="word-wrap:break-word" data-title="'Студент'" filter="{'user.fullName': 'text'}" sortable="'user.fullName'">
                    <a ng-href="#/users/profile/{{row.id_user}}">{{row.user.fullName}}</a>
                </td>
                <td data-title="'Тренер'" filter="{'trainerData.fullName': 'text'}" sortable="'trainerData.fullName'">
                    <a ng-href="#/users/profile/{{row.trainerData.id}}">{{row.trainerData.fullName}}</a>
                </td>
                <td data-title="'Дата розірвання'" filter="{'end_date':'text'}" sortable="'end_date'">
                    <a ng-href="#/users/profile/{{row.id_user}}">{{row.end_date}}</a>
                </td>
                <td data-title="'Група'" filter="{'group.name': 'text'}" sortable="'group.name'">
                    <a ng-href="#/supervisor/offlineGroup/{{row.group.id}}">{{row.group.name}}</a>
                </td>
                <td data-title="'Підгрупа'" sortable="'subgroupName.name'" filter="{'subgroupName.name': 'text'}" >
                    <a ng-href="#/supervisor/offlineSubgroup/{{row.subgroupName.id}}">{{row.subgroupName.name}}</a>
                </td>
                <td data-title="'Причина виключення'" sortable="'cancel_type'" filter="{'cancel_type' : 'select'}" filter-data="types">
                    {{row.cancelType.description}}
                </td>
                <td data-title="'Коментар'" filter="{'comment': 'text'}">
                    {{row.comment}}
                </td>
                <td style="word-wrap:break-word;" data-title="'Телефон'" filter="{'user.phone': 'text'}">
                    {{row.user.phone}}
                </td>
            </tr>
        </table>
    </div>
</div>