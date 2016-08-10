<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="usersTable" datatable="ng" dt-options="dtOptions" dt-column-defs="dtColumnDefs">
                    <thead>
                    <tr>
                        <th >ПІБ</th>
                        <th>Email</th>
                        <th ng-style="{ width:'12%' }">Зареєстровано</th>
                        <th ng-style="{ width:'10%' }">Форма</th>
                        <th>Країна</th>
                        <th>Місто</th>
                        <th>Доступ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="row in usersList">
                        <td><a ng-href="#/admin/users/user/{{row.user.id}}">{{row.user.name}}</a></td>
                        <td><a ng-href="#/admin/users/user/{{row.user.id}}">{{row.email.title}}</a></td>
                        <td>{{row.register}}</a> </td>
                        <td>{{row.register}}</td>
                        <td>{{row.country}}</td>
                        <td>{{row.city}}</td>
                        <td><button type="button" class="btn btn-outline btn-{{row.addAccessLink.color}} btn-block" >{{row.addAccessLink.text}}</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>