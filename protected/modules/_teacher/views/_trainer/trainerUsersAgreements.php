<div class="col-lg-12" ng-controller="trainerUsersAgreementsCtrl">
    <div class="panel panel-default">
        <div class="panel-body">
            <table ng-table="trainerUsersAgreementsTableParams" class="table table-bordered table-striped table-condensed">
                <colgroup>
                    <col/>
                    <col width="20%"/>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col/>
                    <col width="5%"/>
                </colgroup>
                <tr ng-repeat="row in $data track by row.id"
                    ng-class="{'bg-warning': (currentDate>=(row.payment_date  | shortDate:'yyyy-MM-dd') && currentDate<=(row.expiration_date  | shortDate:'yyyy-MM-dd')),
                    'bg-danger': (currentDate>(row.expiration_date  | shortDate:'yyyy-MM-dd') || row.cancel_date),
                    'bg-success': (row.summa==row.paidAmount)}">
                    <td data-title="'Номер'" filter="{number: 'text'}" sortable="'number'">
                        <a ng-href="#/accountant/agreement/{{row.id}}">{{row.number}}</a></td>
                    <td data-title="'Користувач'" filter="{'user.fullName': 'text'}" sortable="'user.fullName'">
                        <a ng-href="#/users/profile/{{row.user_id}}">{{row.user.fullName}}</a>
                    </td>
                    <td data-title="'Дата створення'" filter="{create_date: 'text'}" sortable="'create_date'">
                        {{row.create_date | shortDate:'dd.MM.yyyy'}}
                    </td>
                    <td data-title="'Схема оплати'" filter="{payment_schema: 'select'}" filter-data="getSchemas" sortable="'payment_schema'">
                        {{row.paymentSchema.title_ua}}
                    </td>
                    <td data-title="'Сума до сплати'" filter="{summa: 'text'}" sortable="'summa'">
                        {{row.summa}}
                    </td>
                    <td data-title="'Сплачено'">
                        {{row.paidAmount}}
                    </td>
                    <td data-title="'Наступна проплата до'">
                        {{row.payment_date  | shortDate:'dd.MM.yyyy'}}
                    </td>
                    <td data-title="'Крайній термін сплати'">
                        {{row.expiration_date  | shortDate:'dd.MM.yyyy'}}
                    </td>
                    <td data-title="''" style="text-align: center">
                        <a class="btnChat"  ng-href="#/newmessages/receiver/{{row.id}}"  data-toggle="tooltip" data-placement="top" title="Приватне повідомлення">
                            <i class="fa fa-envelope fa-fw"></i>
                        </a>
                        <a class="btnChat" href="<?php echo Config::getChatPath(); ?>{{row.id}}" target="_blank" data-toggle="tooltip" data-placement="left" title="Чат">
                            <i class="fa fa-weixin fa-fw"></i>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <em style="color:red">*</em>Скасувати можна договір, по якому ще не було жодної проплати та, який ще не скасований<br>
    <span style="background-color: rgba(92,184,92,.6);">Проплачений повністю</span><br>
    <span style="background-color: #f0b370">Збігає термін проплати</span><br>
    <span style="background-color: rgba(217,82,82,.6)">Термін проплати збіг або не оплачений жодний рахунок по договору</span><br>
</div>