<h2 class="m-b-10">Додати нову проплату</h2>
<div class="row" ng-controller="createOperationCtrl">

    <block-window-loader data-control="loaderControl"></block-window-loader>

    <div uib-alert ng-repeat="message in messages" ng-class="'alert-' + (message.type || 'warning')"
         close="closeMessage($index)">{{message.message}}
    </div>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h3>Оберіть зовнішнє джерело коштів </h3>
            <uib-tabset type="pills" justified="true">
                <uib-tab index="0" heading="Існуюче надходження" deselect="clearDocument($event, $selectedIndex)">
                    <find-external-payment data-document="externalPayment"></find-external-payment>
                </uib-tab>
                <uib-tab index="1" heading="Нове надходження" deselect="clearDocument($event, $selectedIndex)">
                    <add-external-payment data-document="externalPayment"
                                          data-show-save-button="false"></add-external-payment>
                </uib-tab>
            </uib-tabset>
        </div>
    </div>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h3>Вкажіть по якому договору (рахунку) оплата </h3>
            <div class="m-b-10">
                <span>Пошук по </span>
                <div class="btn-group">
                    <label ng-repeat="(key, provider) in typeaheadProviders"
                           class="btn btn-default"
                           ng-model="$parent.providerId"
                           uib-btn-radio="'{{key}}'"
                           ng-class="{active:key === $parent.providerId}">
                        {{provider.name}}
                    </label>
                </div>
            </div>

            <div class="input-group m-b-10">
                <span ng-show="!loadingLocations && !noResults" class="input-group-addon" id="gl_icon">
                    <i class="glyphicon glyphicon-pencil"></i>
                </span>
                <span ng-show="loadingLocations" class="input-group-addon" id="gl_icon">
                    <i class="glyphicon glyphicon-refresh"></i>
                </span>
                <span ng-show="noResults" class="input-group-addon" id="gl_icon">
                    <i class="glyphicon glyphicon-remove"></i></span>
                <input
                    aria-describedby="gl_icon"
                    type="text"
                    ng-model="selected"
                    uib-typeahead="typeahead as currentProvider.label(typeahead) for typeahead in getTypeahead($viewValue)"
                    typeahead-loading="loadingLocations"
                    typeahead-no-results="noResults"
                    typeahead-on-select="onSelect($item, $model, $label, $event)"
                    class="form-control">
            </div>

            <div>
                <h3>Дані платежу</h3>

                <div class="form-group row">
                    <label for="userName" class="control-label col-md-2">Користувач</label>
                    <div class="col-md-9">
                        <select class="form-control form-inline" ng-model="operation.userId">
                            <option value="" ng-show="!operation.userId"></option>
                            <option ng-repeat="user in usersList" value="{{user.id}}"
                                    ng-selected="user.id == operation.userId">
                                {{typeaheadProviders.user.label(user);}}
                            </option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-default disabled"><i class="glyphicon glyphicon-eye-open"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="agreement" class="control-label col-md-2">Договір</label>
                    <div class="col-md-9">
                        <select class="form-control form-inline" id="agreement" ng-model="operation.agreementId">
                            <option value="" ng-show="!operation.agreementId"></option>
                            <option ng-repeat="agreement in agreementsList" value="{{agreement.id}}"
                                    ng-selected="agreement.id == operation.agreementId">
                                {{typeaheadProviders.agreement.label(agreement);}}
                            </option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-default no-blur"
                                ng-click="showAgreement(operation.agreementId)"
                                ng-class="{disabled:!operation.agreementId}">
                            <i class="glyphicon glyphicon-eye-open"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="invoice" class="control-label col-md-2">Рахунок</label>
                    <div class="col-md-9">
                        <select class="form-control form-inline" id="invoice" ng-model="operation.invoiceId">
                            <option value="" ng-show="!operation.invoiceId"></option>
                            <option ng-repeat="invoice in invoicesList" value="{{invoice.id}}"
                                    ng-selected="invoice.id == operation.invoiceId">
                                {{typeaheadProviders.invoice.label(invoice);}}
                            </option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-default no-blur"
                                ng-click="showInvoice(operation.invoiceId)"
                                ng-class="{disabled:!operation.invoiceId}">
                            <i class="glyphicon glyphicon-eye-open"></i>
                        </button>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        <button class="btn btn-default form-control no-blur"
                                ng-click="operation.addInvoice(operation.invoiceId)">Додати рахунок
                        </button>
                    </div>
                </div>

                <div ng-repeat="invoice in operation.invoices" class="form-group row">
                    <label class="control-label col-md-2">Рахунок</label>
                    <div class="col-md-7">
                        <label class="control-label"
                               data-value="{{invoice}}">{{typeaheadProviders.invoice.label(invoice)}}</label>
                    </div>
                    <div class="col-md-2">
                        <input type="number" ng-model="invoice.amount" class="form-control form-inline"
                               max="{{invoice.summa}}">
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-default" ng-click="operation.removeInvoice(invoice.id)"><i
                                class="glyphicon glyphicon-minus"></i></button>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sum" class="control-label col-md-2">Сума</label>
                    <div class="col-md-9" id="sum">
                        <input id="sum" type="number" class="form-control form-inline text-right"
                               ng-value="invoicesSum()" ng-pattern="/^[0-9]+(\.[0-9]{1,2})?$/" step="0.01"
                               ng-model="amount"
                               readonly/>
                    </div>
                    <label for="sum" class="control-label col-md-1"> грн.</label>
                </div>

                <div class="form-group row">
                    <div class="col-md-1"></div>
                    <div class="col-md-4">
                        <button class="btn btn-default form-control no-blur" ng-click="createOperation()">Створити
                            платіж
                        </button>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <button class="btn btn-default form-control no-blur" ng-click="cleanUp()">Очистити</button>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>
    </div>

</div>