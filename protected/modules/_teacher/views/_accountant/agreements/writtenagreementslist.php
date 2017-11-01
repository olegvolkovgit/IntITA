<div class="col-lg-12" ng-controller="writtenAgreementsTableCtrl">
    <div class="danger_style">
        *користувач змінив дані після перевірки бухгалтером
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table ng-table="writtenAgreementsTableParams" class="table table-bordered table-striped table-condensed">
                    <colgroup>
                        <col/>
                        <col width="20%"/>
                        <col/>
                        <col width="20%"/>
                        <col/>
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
                        <td data-title="'Дата змін'" filter="{'updatedAt': 'text'}" sortable="'updatedAt'">
                            {{row.updatedAt}}
                        </td>
                        <td data-title="'Затверджено користувачем'" sortable="'checked_by_user'" ng-class="{danger_style: (row.checked_date | timestamp)<(row.lastEditedUserDocument.updatedAt | timestamp)}">
                            {{row.checked_by_user==1?'затверджено':'не затверджено'}}
                        </td>
                        <td data-title="'Затверджено бухгалтером'" sortable="'checked_by_accountant'">
                            {{row.checked_by_accountant==1?'затверджено':'не затверджено'}}
                        </td>
                        <td data-title="'Згенеровано PDF'" sortable="'checked'">
                            {{row.checked==1?'згенеровано':'не згенеровано'}}
                        </td>
                        <td data-title="'Статус'" filter="{'status': 'select'}" filter-data="status">
                        </td>
                        <td data-title="">
                            <a title="переглянути" ng-href="#/accountant/writtenAgreement/id/{{row.id}}">
                                <i class="fa fa-eye fa-fw"></i>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<style>
    .danger_style,td.danger_style{
        border:2px solid red !important;
    }
</style>