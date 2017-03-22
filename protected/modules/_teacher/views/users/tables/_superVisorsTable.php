<br>
<!--    <a type="button" class="btn btn-primary" ng-href="#/admin/users/addrole/supervisor">-->
<!--        Призначити supervisor'а-->
<!--    </a>-->
<a title="Експорт" class="glyphicon glyphicon-floppy-disk btn btn-primary pull-right" style="margin: 5px;"
   href="/_teacher/_admin/users/export/type/supervisors">
</a>
<br>
<br>
<div class="panel panel-default" ng-controller="superVisorsTableCtrl">
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table ng-table="superVisorsTableParams" class="table table-bordered table-striped table-condensed">
                <colgroup>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col width="5%"/>
                </colgroup>
                <tr ng-repeat="row in $data track by $index">
                    <td style="word-wrap:break-word" data-title="'Користувач'" filter="{'user.fullName': 'text'}" sortable="'user.fullName'">
                        <a ng-href="#/users/profile/{{row.id_user}}">{{row.user.fullName}}</a>
                    </td>
                    <td data-title="'Призначено'" filter="{'start_date': 'text'}" sortable="'start_date'">{{row.start_date}}</td>
                    <td data-title="'Призначив'" filter="{'assigned_by_user.fullName': 'text'}" sortable="'assigned_by_user.fullName'">
                        <a ng-href="#/users/profile/{{row.assigned_by}}">{{row.assigned_by_user.fullName}}</a>
                    </td>
                    <td data-title="'Організація'" filter="{'organization.name': 'text'}" sortable="'organization.name'">
                        {{row.organization.name}}
                    </td>
                    <td data-title="''">
                        <a class="btnChat"  ng-href="#/newmessages/receiver/{{row.id_user}}"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">
                            <i class="fa fa-envelope fa-fw"></i>
                        </a>
                        <a class="btnChat" href="<?php echo Config::getChatPath(); ?>{{row.id_user}}" target="_blank" data-toggle="tooltip" data-placement="left" title="Чат">
                            <i class="fa fa-weixin fa-fw"></i>
                        </a>
<!--                            --><?php //if (Yii::app()->user->model->isDirector()) { ?>
<!--                                <a ng-if="!row.end_date" ng-click="cancelRole(row.id_user,'supervisor')" title="Скасувати">-->
<!--                                    <i class="fa fa-trash fa-fw"></i>-->
<!--                                </a>-->
<!--                            --><?php //} ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>