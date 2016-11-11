<div class="panel panel-default">
    <div class="panel-body">
        <table ng-table="offlineStudentsTableParams" class="table table-bordered table-striped table-condensed">
            <tr ng-repeat="row in $data track by $index">
                <td data-title="'ПІБ'" filter="{'user.fullName': 'text'}" sortable="'user.fullName'">
                    <a ng-href="#/supervisor/userProfile/{{row.id_user}}">{{row.user.fullName}}</a>
                </td>
                <td data-title="'Email'" filter="{'user.email': 'text'}" sortable="'user.email'">
                    <a ng-href="#/supervisor/userProfile/{{row.id_user}}">{{row.user.email}}</a>
                </td>
                <td data-title="'Тренер'" sortable="'trainer.trainer'">
                    {{row.trainer.trainer ? 'присутній':''}}
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
                <td data-title="'Скасовано'" sortable="'end_date'" filter="{'end_date': 'text'}">
                    {{row.end_date}}
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