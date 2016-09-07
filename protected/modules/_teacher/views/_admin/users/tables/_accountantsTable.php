<div class="col-lg-12">
    <br>
    <a type="button" class="btn btn-primary" ng-href="#/admin/users/addrole/accountant">
        Призначити бухгалтера
    </a>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table ng-table="accountantsTableParams" class="table table-bordered table-striped table-condensed">
                    <tr ng-repeat="row in $data track by $index">
                        <td data-title="'ПІБ'" filter="{'idUser.fullName': 'text'}" sortable="'idUser.fullName'">
                            <a ng-href="#/admin/users/user/{{row.id_user}}">{{row.idUser.firstName}} {{row.idUser.secondName}}</a>
                        </td>
                        <td data-title="'Email'" sortable="'idUser.email'" filter="{'idUser.email': 'text'}" >
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
                        <td data-title="'Скасувати роль'"><a ng-if="!row.end_date" ng-click="cancelRole('/_teacher/_admin/users/cancelRole','accountant',row.id_user)"><i class="fa fa-trash fa-fw"></i></a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
