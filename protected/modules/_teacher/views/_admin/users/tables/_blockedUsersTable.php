<div class="col-lg-12">
    <br>
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table ng-table="blockedUsersTable" class="table table-bordered table-striped table-condensed">
                    <tr ng-repeat="row in $data track by $index">
                        <td data-title="'ПІБ'">
                            <a ng-href="#/admin/users/user/{{row.registeredUser.id}}">{{row.registeredUser.firstName}} {{row.registeredUser.middleName}} {{row.registeredUser.secondName}}</a>
                        </td>
                        <td data-title="'Email'">
                            <a ng-href="#/admin/users/user/{{row.registeredUser.id}}">{{row.registeredUser.email}}</a>
                        </td>
                        <td data-title="'Дата блокування'">{{row.locked_date | shortDate:"dd-MM-yyyy HH:mm:ss "  }}</td>
                        <td data-title="'Заблоковано користувачем'"><span ng-if="row.lockedBy">{{row.lockedBy.firstName}} {{row.lockedBy.middleName}} {{row.lockedBy.secondName}}</span>
                                                                    <span ng-if="!row.lockedBy">Administrator</span>
                        </td>
                        <td data-title="'Профіль'"><a ng-href="/profile/{{row.registeredUser.id}}" target="_blank">Профіль</a></td>
                        <td data-title="'Розблокувати'"><button class="btn btn-outline btn-success btn-block" ng-click="changeUserStatus('/_teacher/user/changeUserStatus/', row.id, 'Відновити користувача?');">Розблокувати</button></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>