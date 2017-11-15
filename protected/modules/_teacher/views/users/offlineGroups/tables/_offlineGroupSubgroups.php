<div class="panel panel-default">
    <div class="panel-body">
        <div ng-controller="offlineGroupSubgroupsTableCtrl">
            <table ng-table="offlineGroupSubgroupsTableParams" class="table table-bordered table-striped table-condensed">
                <tr ng-repeat="row in $data track by row.id">
                    <td data-title="'Назва'" sortable="'name'" filter="{'name': 'text'}" >
                        <a ng-href="#/offlineSubgroup/{{row.id}}">{{row.name}}</a>
                    </td>
                    <td data-title="'Спеціалізація'" filter="{'specialization.title_ua': 'text'}" sortable="'specialization.title_ua'">{{row.specialization.title_ua}}</td>
                    <td data-title="'Інформація(розклад)'" ><span ng-bind-html="row.data | linky:'_blank'"></span></td>
                    <td data-title="'Журнал'" ><span ng-bind-html="row.journal | linky:'_blank'"></span></td>
                    <td data-title="'Тренер підгрупи'" filter="{'subgroupTrainer.fullName': 'text'}" sortable="'subgroupTrainer.fullName'">
                        <a ng-href="#/users/profile/{{row.id_trainer}}">{{row.subgroupTrainer.fullName}}</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>