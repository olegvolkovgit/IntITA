<div class="col-lg-12">
    <br>
    <a type="button" class="btn btn-primary" ng-href="#/admin/users/addrole/trainer">
        Призначити тренера
    </a>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table ng-table="trainersTableParams" class="table table-bordered table-striped table-condensed">
                    <tr ng-repeat="row in $data track by row.id_user">
                        <td data-title="'ПІБ'" filter="{'idUser.fullName': 'text'}" sortable="'idUser.fullName'">
                            <a ng-href="#/admin/users/user/{{row.id_user}}">{{row.idUser.firstName}} {{row.idUser.middleName}} {{row.idUser.secondName}}</a>
                        </td>
                        <td data-title="'Email'" filter="{'idUser.email': 'text'}" sortable="'idUser.email'">
                            <a ng-href="#/admin/users/user/{{row.id_user}}">{{row.idUser.email}}</a>
                        </td>
                        <td data-title="'Призначено'" filter="{'start_date': 'text'}" sortable="'start_date'">{{row.start_date}}</td>
                        <td data-title="'Відмінено'" filter="{'end_date': 'text'}" sortable="'end_date'">{{row.end_date}}</td>
                        <td data-title="'Профіль'"><a ng-href="/profile/{{row.id_user}}" target="_blank">Профіль</a></td>
                        <td data-title="'Відправити листа'">
                            <a class="btnChat"  ng-href="#/newmessages/receiver/{{row.id_user}}"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">
                                <i class="fa fa-envelope fa-fw"></i>
                            </a>
                        </td>
                        <td data-title="'Скасувати роль'"><a ng-if="!row.end_date" ng-click="cancelRole('/_teacher/_admin/users/cancelRole','trainer',row.id_user)"><i class="fa fa-trash fa-fw"></i></a></td>
                    </tr>
                </table>
                <table class="table table-striped table-bordered table-hover" id="trainersTable" datatable="ng" dt-options="dtOptions">
                    <thead>
                    <tr>
                        <th>ПІБ</th>
                        <th>Email</th>
                        <th>Призначено</th>
                        <th>Відмінено</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="row in trainersList">
                        <td><a ng-href="#/admin/users/user/{{row.id}}">{{row.user.name}}</a></td>
                        <td><a ng-href="#/admin/users/user/{{row.id}}">{{row.email.title}}</a></td>
                        <td>{{row.register}}</a> </td>
                        <td>{{row.cancelDate}}</td>
                        <td>
                            <a class="btnChat"  ng-href="{{row.mailto}}"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">
                                <i class="fa fa-envelope fa-fw"></i>
                            </a>
                        </td>
                        <td><a ng-click="cancelRole(row.cancel,'trainer',row.id)"><i class="fa fa-trash fa-fw"></i></a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>