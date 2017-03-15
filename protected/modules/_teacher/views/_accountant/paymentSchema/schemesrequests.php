<div class="col-lg-12" ng-controller="schemesRequestsTableCtrl">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table ng-table="schemesRequestsTableParams" class="table table-bordered table-striped table-condensed">
                    <colgroup>
                        <col/>
                        <col/>
                        <col/>
                        <col width="10%"/>
                        <col/>
                        <col width="8%"/>
                        <col  width="15%"/>
                        <col  width="15%"/>
                        <col width="4%"/>
                    </colgroup>
                    <tr ng-repeat="row in $data track by $index">
                        <td data-title="'Сервіс'" filter="{'service.description': 'text'}" sortable="'service.description'">
                            <a href="" ng-click="serviceLink(row.service.service_id)" target="_blank">
                                {{row.service.description}}
                            </a>
                        </td>
                        <td data-title="'Схема'" filter="{'schemesTemplate.template_name_ua': 'text'}" sortable="'schemesTemplate.template_name_ua'">
                            <a ng-href="#/accountant/paymentSchemas/schemas/template/{{row.schemesTemplate.id}}" target="_blank">
                                {{row.schemesTemplate.template_name_ua}}
                            </a>
                        </td>
                        <td data-title="'Користувач'" filter="{'user.fullName': 'text'}" sortable="'user.fullName'">
                            <a ng-href="#/users/profile/{{row.user.id}}" target="_blank">{{row.user.fullName}} {{row.user.email}}</a>
                        </td>
                        <td data-title="'Дата запиту'" filter="{'date_create': 'text'}" sortable="'date_create'">
                            {{row.date_create}}
                        </td>
                        <td data-title="'Перевірив'" filter="{'coworkerChecked.fullName': 'text'}" sortable="'coworkerChecked.fullName'">
                            <a ng-href="#/users/profile/{{row.coworkerChecked.user_id}}" target="_blank">{{row.coworkerChecked.fullName}} {{row.coworkerChecked.email}}</a>
                        </td>
                        <td data-title="'Статус'" filter="{'status': 'select'}" filter-data="status">
                            <span ng-if="!row.status">нові</span>
                            <span ng-if="row.status==1">в процесі</span>
                            <span ng-if="row.status==2">затверджені</span>
                            <span ng-if="row.status==3">відхилені</span>
                        </td>
                        <td data-title="'Коментар'" style="text-overflow:clip;word-wrap: break-word" filter="{'comment': 'text'}">
                            {{row.comment}}
                            <a title="залишити коментар" href="" ng-click="setComment(row.id_message,row.comment)">
                                <i class="fa fa-comment fa-fw"></i>
                            </a>
                        </td>
                        <td data-title="'Коментар скасування'" filter="{'reject_comment': 'text'}">
                            {{row.reject_comment}}
                        </td>
                        <td data-title="">
                            <div ng-if="!row.status">
                                <a title="відхилити" href="" ng-click="rejectRequest(row.id_message)"><i class="fa fa-trash fa-fw"></i></a>
                                <a title="в процесі" href="" ng-click="setRequestStatus(row.id_message,1)"><i class="fa fa-clock-o fa-fw"></i></i></a>
                                <a title="застосувати схему" ng-href="#/accountant/paymentSchemas/schemas/apply/request/{{row.id_message}}">
                                    <i class="fa fa-check fa-fw"></i>
                                </a>
                            </div>
                            <div ng-if="row.status==1">
                                <a title="відхилити" href="" ng-click="rejectRequest(row.id_message)"><i class="fa fa-trash fa-fw"></i></a>
                                <a title="застосувати схему" ng-href="#/accountant/paymentSchemas/schemas/apply/request/{{row.id_message}}">
                                    <i class="fa fa-check fa-fw"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

