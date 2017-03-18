
<a title="Експорт" class="glyphicon glyphicon-floppy-disk btn btn-primary pull-right" style="margin: 5px;"
   href="/_teacher/_admin/users/export/type/blockedUsers">
</a>

<div class="col-lg-12">

    <div class="panel panel-default" ng-controller="blockedUsersCtrl">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table ng-table="blockedUsersTable" class="table table-bordered table-striped table-condensed">
                    <tr ng-repeat="row in $data track by $index">
                        <td style="word-wrap:break-word" data-title="'Користувач'" sortable="'registeredUser.fullName'" filter="{'registeredUser.fullName': 'text'}" >
                            <a ng-href="#/users/profile/{{row.registeredUser.id}}">{{row.registeredUser.fullName}}</a>
                        </td>
                        <td data-title="'Дата блокування'" sortable="'locked_date'">{{row.locked_date | shortDate:"dd-MM-yyyy HH:mm:ss "  }}</td>
                        <td data-title="'Заблоковано користувачем'" filter="{'lockedBy.fullName': 'text'}" sortable="'lockedBy.firstName'" >
                            <span ng-if="row.lockedBy">
                                <a ng-href="#/users/profile/{{row.lockedBy.id}}">{{row.lockedBy.fullName}}</a>
                            </span>
                            <span ng-if="!row.lockedBy">Administrator</span>
                        </td>
                        <?php if (Yii::app()->user->model->canUnlockUser()) { ?>
                        <td data-title="'Розблокувати'">
                            <button class="btn btn-outline btn-success btn-block"
                                    ng-click="changeUserStatus('<?= Yii::app()->createUrl("/_teacher/user/changeUserStatus"); ?>', row.id_user, 'Відновити користувача?');">
                                Розблокувати
                            </button>
                        </td>
                        <?php } ?>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>