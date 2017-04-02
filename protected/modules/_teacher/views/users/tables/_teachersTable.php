<br>
<div style="overflow: hidden">
    <?php if (Yii::app()->user->model->isAdmin()) { ?>
    <a type="button" class="btn btn-primary" ng-href="#/admin/teacher/create">
        Додати співробітника
    </a>
    <?php } ?>
    <a title="Експорт" class="glyphicon glyphicon-floppy-disk btn btn-primary pull-right" style="margin: 5px;"
       href="/_teacher/_admin/users/export/type/teachers">
    </a>
</div>
<br>
<div class="panel panel-default" ng-controller="teachersTableCtrl" organization="<?php echo $organization ?>">
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table ng-table="teachersTableParams" class="table table-bordered table-striped table-condensed">
                <colgroup>
                    <col/>
                    <col/>
                    <?php if (Yii::app()->user->model->isAdmin()) { ?>
                        <col/>
                    <?php } ?>
                    <col/>
                    <col/>
                    <col/>
                    <col width="5%"/>
                </colgroup>
                <tr ng-repeat="row in $data track by $index">
                    <td style="word-wrap:break-word" data-title="'Користувач'" filter="{'user.fullName': 'text'}" sortable="'user.fullName'">
                        <a ng-href="#/users/profile/{{row.user.id}}">{{row.user.fullName}}</a>
                    </td>
                    <td data-title="'Статус'" sortable="'isPrint'">{{row.isPrint==1  ? "видимий" : "невидимий"}}</td>
                    <?php if (Yii::app()->user->model->isAdmin()) { ?>
                    <td data-title="'Змінити статус'" sortable="'isPrint'">
                        <a ng-click="setTeacherStatus(row.isPrint, row.user.id)">{{row.isPrint==1  ? "приховати" : "показати"}}</a>
                    </td>
                    <?php } ?>
                    <td data-title="'Призначено'" filter="{'start_date': 'text'}" sortable="'start_date'">{{row.start_date}}</td>
                    <td data-title="'Призначив'" filter="{'assigned_by_user.fullName': 'text'}" sortable="'assigned_by_user.fullName'">
                        <a ng-href="#/users/profile/{{row.assigned_by}}">{{row.assigned_by_user.fullName}}</a>
                    </td>
                    <td data-title="'Організація'" filter="{'organization.name': 'text'}" sortable="'organization.name'">
                        {{row.organization.name}}
                    </td>
                    <td data-title="''">
                        <a class="btnChat"  ng-href="#/newmessages/receiver/{{row.user.id}}"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">
                            <i class="fa fa-envelope fa-fw"></i>
                        </a>
                        <a class="btnChat" href="<?php echo Config::getChatPath(); ?>{{row.user.id}}" target="_blank" data-toggle="tooltip" data-placement="left" title="Чат">
                            <i class="fa fa-weixin fa-fw"></i>
                        </a>
                        <a ng-if="!row.end_date" ng-click="cancelTeacher(row.id_user)"><i class="fa fa-trash fa-fw"></i></a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>