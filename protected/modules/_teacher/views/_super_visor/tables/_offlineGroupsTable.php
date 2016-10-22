<a type="button" class="btn btn-primary" ng-href="#/supervisor/addOfflineGroup">
    Створити оффлайн групу
</a>
<br>
<br>
<table ng-table="offlineGroupsTableParams" class="table table-bordered table-striped table-condensed">
    <tr ng-repeat="row in $data track by row.id">
        <td data-title="'Назва'" sortable="'name'" filter="{'name': 'text'}" >
            <a ng-href="#/supervisor/offlineGroup/{{row.id}}">{{row.name}}</a>
        </td>
        <td data-title="'Дата створення'" filter="{'start_date': 'text'}" sortable="'start_date'">{{row.start_date}}</td>
        <td data-title="'Спеціалізація'" filter="{'specializationName.name': 'text'}" sortable="'specializationName.name'">{{row.specializationName.name}}</td>
        <td data-title="'Місто'" filter="{'cityName.title_ua': 'text'}" sortable="'cityName.title_ua'">{{row.cityName.title_ua}}</td>
    </tr>
</table>