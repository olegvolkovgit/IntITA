<div class="panel panel-default">
    <div class="panel-body">
        <div ng-controller="offlineSubgroupsTableCtrl">
            <table ng-table="offlineSubgroupsTableParams" class="table table-bordered table-striped table-condensed">
                <tr ng-repeat="row in $data track by row.id">
                    <td data-title="'Назва'" sortable="'name'" filter="{'name': 'text'}" >
                        <a ng-href="#/supervisor/offlineSubgroup/{{row.id}}">{{row.name}}</a>
                    </td>
                    <td data-title="'Група'" filter="{'groupName.name': 'text'}" sortable="'groupName.name'">
                        <a ng-href="#/supervisor/offlineGroup/{{row.groupName.id}}">{{row.groupName.name}}</a>
                    </td>
                    <td data-title="'Інформація(розклад)'" ><a href="{{row.data}}" target="_blank">{{row.data}}</a></td>
                </tr>
            </table>
        </div>
    </div>
</div>