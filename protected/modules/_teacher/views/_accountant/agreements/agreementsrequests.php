<div class="col-lg-12" ng-controller="agreementsRequestsTableCtrl">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table ng-table="agreementsRequestsTableParams" class="table table-bordered table-striped table-condensed">
                    <colgroup>
                        <col/>
                        <col width="20%"/>
                        <col/>
                        <col width="20%"/>
                        <col/>
                        <col/>
                        <col width="4%"/>
                    </colgroup>
                    <tr ng-repeat="row in $data track by $index">
                        <td data-title="'Сервіс'" filter="{'service.description': 'text'}" sortable="'service.description'">
                            <a href="" ng-click="serviceLink(row.service.service_id)" target="_blank">
                                {{row.service.description}}
                            </a>
                        </td>
                        <td data-title="'Користувач'" filter="{'user.fullName': 'text'}" sortable="'user.fullName'">
                            <a ng-href="#/users/profile/{{row.user.id}}" target="_blank">{{row.user.fullName}}</a>
                        </td>
                        <td data-title="'Дата запиту'" filter="{'date_create': 'text'}" sortable="'date_create'">
                            {{row.date_create}}
                        </td>
                        <td data-title="'Затвердив'" filter="{'coworkerChecked.fullName': 'text'}" sortable="'coworkerChecked.fullName'">
                            <a ng-href="#/users/profile/{{row.coworkerChecked.id}}" target="_blank">{{row.coworkerChecked.fullName}}</a>
                        </td>
                        <td data-title="'Статус'" filter="{'status': 'select'}" filter-data="status">
                            <span ng-if="row.status!=1 && !(!row.status && row.user_checked)">нові</span>
                            <span ng-if="row.status==1">затверджені</span>
                            <span ng-if="!row.status && row.user_checked">відхилені</span>
                        </td>
                        <td data-title="'Коментар скасування'" filter="{'reject_comment': 'text'}">
                            {{row.reject_comment}}
                        </td>
                        <td data-title="">
                            <a title="переглянути" ng-href="#/accountant/writtenAgreementView/request/{{row.id_message}}">
                                <i class="fa fa-eye fa-fw"></i>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>