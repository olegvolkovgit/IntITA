<div class="panel panel-default" ng-controller="paymentsSchemesTableCtrl" organization="<?php echo $organization ?>">
    <div class="panel-body">
        <ul class="list-inline">
            <li>
                <a ng-href="#/accountant/paymentSchemas/schemas/template" class="btn btn-primary">
                    Шаблони схем
                </a>
            </li>
            <li>
                <a ng-href="#/accountant/paymentSchemas/schemas/createTemplate" class="btn btn-primary">
                    Додати шаблон схем
                </a>
            </li>
            <li>
                <a ng-href="#/accountant/paymentSchemas/schemas/apply" class="btn btn-primary">
                    Застосувати шаблон схем
                </a>
            </li>
            <li>
                <a ng-href="#/accountant/paymentSchemas/schemas/displaypromotion" class="btn btn-primary">
                    Застосування акцій до сервісів
                </a>
            </li>
            <li>
                <a ng-href="#/accountant/paymentSchemas/schemas/displaypromotionlist" class="btn btn-primary">
                    Список застосованих акцій
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <uib-tabset>
                <uib-tab  index="0" heading="Основні схеми">
                    <table ng-table="mainTemplateTableParams" class="table table-bordered table-striped table-condensed">
                        <tr ng-repeat="row in $data track by row.id">
                            <td data-title="'Схеми'">
                                <span ng-if="row.id==1">Схеми по замовчуванню для курсів</span>
                                <span ng-if="row.id==2">Схеми по замовчуванню для модулів</span>
                            </td>
                            <td data-title="'Назва шаблону'" filter="{'schemesTemplate.template_name_ua': 'text'}" sortable="'schemesTemplate.template_name_ua'">
                                <a ng-href="#/accountant/paymentSchemas/schemas/template/{{row.id_template}}">{{row.schemesTemplate.template_name_ua}}</a>
                            </td>
                            <td data-title="'Початок'" filter="{'startDate': 'text'}" sortable="'startDate'">{{row.startDate}}</td>
                            <td data-title="'Закінчення'" filter="{'endDate': 'text'}" sortable="'endDate'">{{row.endDate}}</td>
                        </tr>
                    </table>
                </uib-tab>
                <uib-tab  index="1" heading="Схеми застосовані до сервісів">
                    <table ng-table="servicesTemplateTableParams" class="table table-bordered table-striped table-condensed">
                        <colgroup>
                            <col width="5%"/>
                            <col width="20%"/>
                            <col width="20%"/>
                            <col/>
                            <col/>
                            <col width="5%"/>
                        </colgroup>
                        <tr ng-repeat="row in $data track by row.id">
                            <td data-title="'id'" >{{row.id}}</td>
                            <td data-title="'Назва шаблону'" filter="{'schemesTemplate.template_name_ua': 'text'}" sortable="'schemesTemplate.template_name_ua'">
                                <a ng-href="#/accountant/paymentSchemas/schemas/template/{{row.id_template}}">{{row.schemesTemplate.template_name_ua}}</a>
                            </td>
                            <td data-title="'Сервіс'" filter="{'service.description': 'text'}" sortable="'service.description'">
                                {{row.service.description}}
                            </td>
                            <td data-title="'Початок'" filter="{'startDate': 'text'}" sortable="'startDate'">{{row.startDate}}</td>
                            <td data-title="'Закінчення'" filter="{'endDate': 'text'}" sortable="'endDate'">{{row.endDate}}</td>
                            <td data-title="">
                                <a href="" ng-click="cancelPaymentScheme(row.id)"><i class="fa fa-trash fa-fw"></i></a>
                            </td>
                        </tr>
                    </table>
                </uib-tab>
                <uib-tab  index="2" heading="Схеми застосовані до користувачів">
                    <table ng-table="usersTemplateTableParams" class="table table-bordered table-striped table-condensed">
                        <colgroup>
                            <col width="5%"/>
                            <col width="20%"/>
                            <col width="20%"/>
                            <col/>
                            <col/>
                            <col/>
                            <col width="5%"/>
                        </colgroup>
                        <tr ng-repeat="row in $data track by row.id">
                            <td data-title="'id'" >{{row.id}}</td>
                            <td data-title="'Назва шаблону'" filter="{'schemesTemplate.template_name_ua': 'text'}" sortable="'schemesTemplate.template_name_ua'">
                                <a ng-href="#/accountant/paymentSchemas/schemas/template/{{row.id_template}}">{{row.schemesTemplate.template_name_ua}}</a>
                            </td>
                            <td style="word-wrap:break-word" data-title="'Користувач'" filter="{'user.fullName': 'text'}" sortable="'user.fullName'">
                                <a ng-href="#/users/profile/{{row.userId}}">{{row.user.fullName}}</a>
                            </td>
                            <td data-title="'Сервіс'" filter="{'service.description': 'text'}" sortable="'service.description'">
                                {{row.service.description}}
                            </td>
                            <td data-title="'Початок'" filter="{'startDate': 'text'}" sortable="'startDate'">{{row.startDate}}</td>
                            <td data-title="'Закінчення'" filter="{'endDate': 'text'}" sortable="'endDate'">{{row.endDate}}</td>
                            <td data-title="">
                                <a href="" ng-click="cancelPaymentScheme(row.id)"><i class="fa fa-trash fa-fw"></i></a>
                            </td>
                        </tr>
                    </table>
                </uib-tab>
            </uib-tabset>
        </div>
    </div>
</div>