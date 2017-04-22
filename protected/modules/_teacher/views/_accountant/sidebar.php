<li ng-controller="mainAccountantCtrl">
    <a ng-href="#/accountant" ng-click="changeView('accountant')">
        <i class="fa fa-bar-chart-o fa-fw"></i>Бухгалтер
        <span ng-cloak class="label label-success" ng-if="countOfActualSchemesRequests > 0">{{countOfActualSchemesRequests}}</span>
        <span class="fa arrow"></span>
    </a>
    <ul class="nav nav-second-level">
        <li>
            <a href="#/accountant/agreements">Список договорів</a>
        </li>
        <li>
            <a href="#/accountant/invoices">Список рахунків</a>
        </li>
        <li>
            <a href="#/accountant/operation">Проплати</a>
        </li>
        <li>
            <a ui-sref="accountant.company.list">Компанії</a>
        </li>
        <li>
            <a href="#/accountant/externalsources">Зовнішні джерела коштів</a>
        </li>
        <li>
            <a href="#/accountant/cancelreasontype">Причини відміни проплат</a>
        </li>
        <li>
            <a href="#/accountant/paymentSchemas/schemas/template">Шаблони схем</a>
        </li>
        <li>
            <a href="#/accountant/paymentSchemas/schemas/apply">Застосувати шаблон схем</a>
        </li>
        <li>
            <a href="#/accountant/paymentSchemas/schemas/appliedTemplates">Список застосованних шаблонів схем</a>
        </li>
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
        <li>
            <a href="#/accountant/documents">Копії документів</a>
        </li>
        <li>
            <a href="#/accountant/schemesrequests">
                Запити на застосування схем проплат
                <span ng-cloak class="label label-success" ng-if="countOfActualSchemesRequests > 0">{{countOfActualSchemesRequests}}</span>
            </a>
        </li>
    </ul>
</li>