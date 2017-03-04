<div class="panel panel-default" ng-controller="paymentsSchemesTableCtrl">
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
                                <span ng-if="row.id==2">Акційні схеми для курсів</span>
                                <span ng-if="row.id==3">Схеми по замовчуванню для модулів</span>
                                <span ng-if="row.id==4">Акційні схеми для модулів</span>
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
                            <td data-title="'Скасувати'">
                                <a ng-click="cancelPaymentScheme(row.id)"><i class="fa fa-trash fa-fw"></i></a>
                            </td>
                        </tr>
                    </table>
                </uib-tab>
                <uib-tab  index="2" heading="Схеми застосовані до користувачів">
                    <table ng-table="usersTemplateTableParams" class="table table-bordered table-striped table-condensed">
                        <tr ng-repeat="row in $data track by row.id">
                            <td data-title="'id'" >{{row.id}}</td>
                            <td data-title="'Назва шаблону'" filter="{'schemesTemplate.template_name_ua': 'text'}" sortable="'schemesTemplate.template_name_ua'">
                                <a ng-href="#/accountant/paymentSchemas/schemas/template/{{row.id_template}}">{{row.schemesTemplate.template_name_ua}}</a>
                            </td>
                            <td data-title="'Користувач'" filter="{'user.fullName': 'text'}" sortable="'user.fullName'">
                                <a ng-href="#/admin/users/user/{{row.userId}}">{{row.user.firstName}} {{row.user.middleName}} {{row.user.secondName}}</a>
                            </td>
                            <td data-title="'Email'" sortable="'user.email'" filter="{'user.email': 'text'}">
                                <a ng-href="#/admin/users/user/{{row.userId}}">{{row.user.email}}</a>
                            </td>
                            <td data-title="'Сервіс'" filter="{'service.description': 'text'}" sortable="'service.description'">
                                {{row.service.description}}
                            </td>
                            <td data-title="'Початок'" filter="{'startDate': 'text'}" sortable="'startDate'">{{row.startDate}}</td>
                            <td data-title="'Закінчення'" filter="{'endDate': 'text'}" sortable="'endDate'">{{row.endDate}}</td>
                            <td data-title="'Скасувати'">
                                <a ng-click="cancelPaymentScheme(row.id)"><i class="fa fa-trash fa-fw"></i></a>
                            </td>
                        </tr>
                    </table>
                </uib-tab>
            </uib-tabset>
        </div>
    </div>
</div>