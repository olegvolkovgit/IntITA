<table ng-table="usersTableParams" class="table table-bordered table-striped table-condensed">
    <tr ng-repeat="row in $data track by row.id">
        <td data-title="'ПІБ'" sortable="'fullName'" filter="{'fullName': 'text'}" >
            <a ng-href="#/supervisor/userProfile/{{row.id}}">{{row.fullName}}</a>
        </td>
        <td data-title="'Email'" filter="{'email': 'text'}" sortable="'email'">
            <a ng-href="#/supervisor/userProfile/{{row.id}}">{{row.email}}</a>
        </td>
        <td data-title="'Зареєстровано'" filter="{'reg_time': 'text'}" sortable="'reg_time'">{{row.reg_time=='0000-00-00 00:00:00'  ? "невідомо" : row.reg_time}}</td>
        <td data-title="'Країна'" filter="{'country0.title_ua': 'text'}" sortable="'country0.title_ua'">{{row.country0.title_ua}}</td>
        <td data-title="'Місто'" filter="{'city0.title_ua': 'text'}" sortable="'city0.title_ua'">{{row.city0.title_ua}}</td>
    </tr>
</table>