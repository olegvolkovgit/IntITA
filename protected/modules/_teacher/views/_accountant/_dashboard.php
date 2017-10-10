<div class="row">
    <div class="col-lg-12">
        Бухгалтер
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-green">
            <div class="panel-heading">
                Головне
            </div>
            <div class="panel-body">
                <ul>
                    <li>
                        <a href="#/accountant/agreements">Список договорів</a>
                    </li>
                    <li>
                        <a href="#/accountant/invoices">Список рахунків</a>
                    </li>
                    <li>
                        <a href="#/accountant/operation">Проплати</a>
                    </li>
                </ul>
                <br>
            </div>
            <div class="panel-footer">
                <em>Основні операції</em>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                Компанії
            </div>
            <div class="panel-body">
                <ul>
                    <li>
                        <a ui-sref="accountant.company.list">Компанії</a>
                    </li>
                </ul>
                <br>
                <br>
                <br>
            </div>
            <div class="panel-footer">
                <em>Компанії, їх представники та рахунки</em>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Користувачі та їх документи
            </div>
            <div class="panel-body">
                <ul>
                    <li>
                        <a href="#/registeredUsers">Зареєстровані користувачі</a>
                    </li>
                    <li>
                        <a href="#/students">Студенти</a>
                    </li>
                    <li>
                        <a href="#/accountant/documents">Копії документів</a>
                    </li>
                </ul>
                <br>
                <br>
            </div>
            <div class="panel-footer">
                <em>Копії документів користувачів</em>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-green">
            <div class="panel-heading">
                Схеми проплат
            </div>
            <div class="panel-body">
                <ul>
                    <li>
                        <a ng-href="#/accountant/paymentSchemas/schemas/template">
                            Шаблони схем
                        </a>
                    </li>
                    <li>
                        <a ng-href="#/accountant/paymentSchemas/schemas/apply">Застосувати шаблон схем</a>
                    </li>
                    <li>
                        <a ng-href="#/accountant/paymentSchemas/schemas/appliedTemplates">Список застосованних шаблонів
                            схем</a>
                    </li>
                    <br>
                    <hr>
                    <li>
                        <a ng-href="#/accountant/paymentSchemas/schemas/displaypromotion">
                            Застосування акцій до сервісів
                        </a>
                    </li>
                    <li>
                        <a ng-href="#/accountant/paymentSchemas/schemas/displaypromotionlist">
                            Список застосованих акцій
                        </a>
                    </li>
                </ul>
            </div>
            <div class="panel-footer">
                <em>Схеми оплат(індивідуальні скидки, акції тощо)</em>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                Запити
            </div>
            <div class="panel-body">
                <ul>
                    <li>
                        <a href="#/accountant/schemesrequests">
                            Запити на застосування схем проплат
                            <span ng-cloak class="label label-success" ng-if="countOfActualSchemesRequests > 0">{{countOfActualSchemesRequests}}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#/accountant/agreementsrequests">
                            Запити на затвердження паперових договорів
                            <span ng-cloak class="label label-primary" ng-if="countOfActualWrittenAgreementRequests > 0">{{countOfActualWrittenAgreementRequests}}</span>
                        </a>
                    </li>
                </ul>
                <br>
                <br>
            </div>
            <div class="panel-footer">
                <em>Запити користувачів</em>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Паперові договора
            </div>
            <div class="panel-body">
                <ul>
                    <li>
                        <a ng-href="#/accountant/writtenAgreement">Шаблон паперового договору</a>
                    </li>
                </ul>
                <br>
                <br>
            </div>
            <div class="panel-footer">
                <em>Паперові договора</em>
            </div>
        </div>
    </div>
</div>