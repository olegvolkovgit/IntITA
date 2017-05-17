<div class="panel panel-default" ng-controller="modulesRatingTableCtrl">
    <div class="panel-body">
        <div class="dataTable_wrapper">
            <table ng-table="modulesRatingTableParams" class="table table-bordered table-striped table-condensed">
                <colgroup>
                    <col/>
                    <col width="10%"/>
                    <col width="10%"/>
                    <col width="10%"/>
                    <col/>
                    <col width="5%"/>
                </colgroup>
                <tr ng-repeat="row in $data track by $index">
                    <td style="word-wrap:break-word" data-title="'Назва модуля'" filter="{'module.title_ua': 'text'}"                                                                           sortable="'module.title_ua'">
                        <a ng-href="" ng-click="moduleLink(row.id_module)">{{row.module.title_ua}}</a>
                    </td>
                    <td data-title="'Рейтинг по зрозумілості'" filter="{'understand_rating': 'text'}"                                                                                       sortable="'understand_rating'">
                        {{row.understand_rating}}
                    </td>
                    <td data-title="'Рейтинг по цікавості'" filter="{'interesting_rating': 'text'}"                                                                                     sortable="'interesting_rating'">
                        {{ row.interesting_rating }}
                    </td>
                    <td data-title="'Рейтинг по доступності'" filter="{'accessibility_rating': 'text'}"                                                                                         sortable="'accessibility_rating'">
                        {{row.accessibility_rating}}
                    </td>

                    <td style="word-wrap:break-word" data-title="'Студенти'" filter="{'idUser.fullName': 'text'}" sortable="'idUser.fullName'">
                        <a ng-href="#/users/profile/{{row.id_user}}">{{row.idUser.fullName}}</a>
                    </td>


                    <td data-title="''">
                        <a class="btnChat"  ng-href="#/newmessages/receiver/{{row.id_user}}"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">
                            <i class="fa fa-envelope fa-fw"></i>
                        </a>
                        <a class="btnChat" href="<?php echo Config::getChatPath(); ?>{{row.id_user}}" target="_blank" data-toggle="tooltip" data-placement="left" title="Чат">
                            <i class="fa fa-weixin fa-fw"></i>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

