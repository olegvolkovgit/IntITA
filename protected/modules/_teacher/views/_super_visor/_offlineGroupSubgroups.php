<div class="panel panel-default">
    <div class="panel-body">
        <div ng-controller="offlineGroupSubgroupsTableCtrl">
            <a type="button" class="btn btn-primary" ng-href="#/supervisor/group/{{groupId}}/addOfflineSubgroup">
                Додати оффлайн підгрупу
            </a>
            <br>
            <br>
            <table ng-table="offlineGroupSubgroupsTableParams" class="table table-bordered table-striped table-condensed">
                <tr ng-repeat="row in $data track by row.id">
                    <td data-title="'Назва'" sortable="'name'" filter="{'name': 'text'}" >
                        <a ng-href="#/supervisor/offlineSubgroup/{{row.id}}">{{row.name}}</a>
                    </td>
                    <td data-title="'Спеціалізація'" filter="{'specializationName.name': 'text'}" sortable="'specializationName.name'">{{row.specializationName.name}}</td>
                    <td data-title="'Інформація(розклад)'" ><a href="{{row.data}}" target="_blank">{{row.data}}</a></td>
                </tr>
            </table>
        </div>
    </div>
</div>