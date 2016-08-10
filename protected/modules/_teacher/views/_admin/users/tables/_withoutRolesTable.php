<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="withoutRolesTable" datatable="ng" dt-options="dtOptions">
                    <thead>
                    <tr>
                        <th>ПІБ</th>
                        <th>Email</th>
                        <th>Зареєстровано</th>
                        <th>Країна</th>
                        <th>Місто</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="row in withoutRolesList">
                        <td><a ng-href="#/admin/users/user/{{row.user.id}}">{{row.user.name}}</a></td>
                        <td><a ng-href="#/admin/users/user/{{row.user.id}}">{{row.email.title}}</a></td>
                        <td>{{row.register}}</td>
                        <td>{{row.country}}</td>
                        <td>{{row.city}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>