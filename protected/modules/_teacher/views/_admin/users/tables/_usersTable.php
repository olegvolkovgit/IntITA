<table ng-table="usersTableParams" class="table table-bordered table-striped table-condensed">
    <tr ng-repeat="row in $data track by row.id">
        <td data-title="'ПІБ'" filter="{'fullName': 'text'}" >
            <a ng-href="#/admin/users/user/{{row.id}}">{{row.firstName}} {{row.middleName}} {{row.secondName}}</a>
        </td>
        <td data-title="'Email'" filter="{'email': 'text'}" sortable="'email'">
            <a ng-href="#/admin/users/user/{{row.id}}">{{row.email}}</a>
        </td>
        <td data-title="'Зареєстровано'" filter="{'reg_time': 'text'}" sortable="'reg_time'">{{row.reg_time=='0000-00-00 00:00:00'  ? "невідомо" : row.reg_time}}</td>
        <td data-title="'Країна'">{{row.country0.title_ua}}</td>
        <td data-title="'Місто'">{{row.city.title_ua}}</td>
        <td data-title="'Доступ до контенту'" >
            <a type="button"
               ng-class="{'btn btn-outline btn-success btn-block': (row.payCourses.length || row.payModules.length),
              'btn btn-outline btn-danger btn-block': (!row.payCourses.length && !row.payModules.length) }" ng-href="#/admin/users/user/{{row.id}}">
                {{(row.payCourses.length || row.payModules.length)? "є доступ":"немає доступу"}}
            </a>
        </td>
    </tr>
</table>
<!--todo-->
<!--sortable="'fullName'"-->
<!--filter="{'country0.title_ua': 'text'}" sortable="'country0.title_ua'"-->
<!--filter="{'city0.title_ua': 'text'}" sortable="'city0.title_ua'"-->
<!--filter="{'payCourses': 'text'}" sortable="'payCourses'"-->