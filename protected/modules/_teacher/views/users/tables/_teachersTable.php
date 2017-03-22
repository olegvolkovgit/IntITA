<br>
<!--<div>-->
<!--    <a type="button" class="btn btn-primary" ng-href="#/admin/teacher/create">-->
<!--        Додати співробітника-->
<!--    </a>-->
<!--    <a title="Експорт" class="glyphicon glyphicon-floppy-disk btn btn-primary pull-right" style="margin: 5px;"-->
<!--       href="/_teacher/_admin/users/export/type/teachers">-->
<!--    </a>-->
<!--</div>-->
<br>
<div class="panel panel-default" ng-controller="teachersTableCtrl">
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table ng-table="teachersTableParams" class="table table-bordered table-striped table-condensed">
                <colgroup>
                    <col/>
                    <col width="5%"/>
                </colgroup>
                <tr ng-repeat="row in $data track by row.user_id">
                    <td style="word-wrap:break-word" data-title="'Користувач'" filter="{'user.fullName': 'text'}" sortable="'user.fullName'">
                        <a ng-href="#/users/profile/{{row.user.id}}">{{row.user.fullName}}</a>
                    </td>
<!--                    <td data-title="'Статус'" sortable="'isPrint'">{{row.isPrint==1  ? "видимий" : "невидимий"}}</td>-->
<!--                    <td data-title="'Змінити статус'" sortable="'isPrint'">-->
<!--                        <a ng-click="setTeacherStatus(row.isPrint, row.user.id)">{{row.isPrint==1  ? "приховати" : "показати"}}</a>-->
<!--                    </td>-->
                    <td data-title="''">
                        <a class="btnChat"  ng-href="#/newmessages/receiver/{{row.user.id}}"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">
                            <i class="fa fa-envelope fa-fw"></i>
                        </a>
                        <a class="btnChat" href="<?php echo Config::getChatPath(); ?>{{row.user.id}}" target="_blank" data-toggle="tooltip" data-placement="left" title="Чат">
                            <i class="fa fa-weixin fa-fw"></i>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>