<div class="col-lg-12">

    <a title="Експорт" class="glyphicon glyphicon-floppy-disk btn btn-primary pull-right" style="margin: 5px;"
           href="/_teacher/_admin/users/export/type/all">
    </a>

</div>
<table ng-table="usersTableParams" class="table table-bordered table-striped table-condensed">
    <tr ng-repeat="row in $data track by row.id">
        <td data-title="'ПІБ'" sortable="'fullName'" filter="{'fullName': 'text'}" >
            <a ng-href="#/admin/users/user/{{row.id}}">{{row.firstName}} {{row.middleName}} {{row.secondName}}</a>
        </td>
        <td data-title="'Email'" filter="{'email': 'text'}" sortable="'email'">
            <a ng-href="#/admin/users/user/{{row.id}}">{{row.email}}</a>
        </td>
        <td data-title="'Зареєстровано'" filter="{'reg_time': 'text'}" sortable="'reg_time'">{{row.reg_time=='0000-00-00 00:00:00'  ? "невідомо" : row.reg_time}}</td>
        <td data-title="'Країна'" filter="{'country0.title_ua': 'text'}" sortable="'country0.title_ua'">{{row.country0.title_ua}}</td>
        <td data-title="'Місто'" filter="{'city0.title_ua': 'text'}" sortable="'city0.title_ua'">{{row.city0.title_ua}}</td>
        <td data-title="'Доступ до контента (по договору)'">
            <a type="button"
               ng-class="{'btn btn-outline btn-success btn-block': row.serviceAccess.length,
              'btn btn-outline btn-danger btn-block': !row.serviceAccess.length }" ng-href="#/admin/users/user/{{row.id}}">
                {{row.serviceAccess.length? "є доступ":"немає доступу"}}
            </a>
        </td>
    </tr>
</table>
