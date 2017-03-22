<div ng-controller="usersTableCtrl">
    <div class="col-lg-12">
        <a title="Експорт" class="glyphicon glyphicon-floppy-disk btn btn-primary pull-right" style="margin: 5px;"
               href="/_teacher/_admin/users/export/type/all">
        </a>
    </div>
    <table ng-table="usersTableParams" class="table table-bordered table-striped table-condensed">
        <colgroup>
            <col width="30%"/>
            <col/>
            <col/>
            <col/>
            <col/>
        </colgroup>
        <tr ng-repeat="row in $data track by row.id">
            <td style="word-wrap:break-word" data-title="'Користувач'" sortable="'fullName'" filter="{'fullName': 'text'}" >
                <a ng-href="#/users/profile/{{row.id}}">{{row.fullName}}</a>
            </td>
            <td data-title="'Профіль'"><a ng-href="/profile/{{row.id}}" target="_blank">Профіль</a></td>
            <td data-title="'Зареєстровано'" filter="{'reg_time': 'text'}" sortable="'reg_time'">{{row.reg_time=='0000-00-00 00:00:00'  ? "" : row.reg_time}}</td>
            <td data-title="'Країна'" filter="{'country0.title_ua': 'text'}" sortable="'country0.title_ua'">{{row.country0.title_ua}}</td>
            <td data-title="'Місто'" filter="{'city0.title_ua': 'text'}" sortable="'city0.title_ua'">{{row.city0.title_ua}}</td>
        </tr>
    </table>
</div>
