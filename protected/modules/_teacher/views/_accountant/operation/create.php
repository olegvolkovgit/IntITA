<h2 class="m-b-10">Додати нову проплату</h2>
<div class="row" ng-controller="createOperationCtrl">
    <toast style="left:0px"></toast>
    <div class="panel-body">
        <div class="formMargin">
            <div class="col-lg-8">
                <block-window-loader data-control="loaderControl"></block-window-loader>

                <div class="row">
                    <h3>Оберіть проплату</h3>
                    <uib-tabset type="pills" justified="true">
                        <uib-tab index="0" heading="Існуюча проплата" deselect="clearDocument($event, $selectedIndex)">
                            <find-external-payment data-document="externalPayment"></find-external-payment>
                        </uib-tab>
                        <uib-tab index="1" heading="Нова проплата" deselect="clearDocument($event, $selectedIndex)">
                            <add-external-payment data-document="externalPayment"
                                                  data-show-save-button="false"
                                                  data-form-dirty="formDirty">
                            </add-external-payment>
                        </uib-tab>
                    </uib-tabset>
                </div>
                <div class="row">
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
                            <i class="glyphicon glyphicon-remove"></i>
                        </span>
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
                                <a class="btn btn-default no-blur"
                                   ng-href="#/users/profile/{{operation.userId}}"
                                   target="_blank"
                                   ng-class="{disabled:!operation.userId}">
                                    <i class="glyphicon glyphicon-eye-open"></i>
                                </a>
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
                                <a class="btn btn-default no-blur"
                                   ng-href="#/accountant/agreement/{{operation.agreementId}}"
                                   target="_blank"
                                   ng-class="{disabled:!operation.agreementId}">
                                    <i class="glyphicon glyphicon-eye-open"></i>
                                </a>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="invoice" class="control-label col-md-2">Рахунок</label>
                            <div class="col-md-9">
                                <select class="form-control form-inline" id="invoice" ng-model="operation.invoiceId">
                                    <option value="" ng-show="!operation.invoiceId"></option>
                                    <option ng-class="{startPayment: invoice.paidAmount>0 && invoice.paidAmount<invoice.summa}"
                                            ng-repeat="invoice in invoicesList" value="{{invoice.id}}"
                                            ng-selected="invoice.id == operation.invoiceId"
                                            ng-disabled="invoice.summa<=invoice.paidAmount">
                                        {{typeaheadProviders.invoice.label(invoice);}}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <a class="btn btn-default no-blur"
                                        ng-href="#/accountant/invoice/{{operation.invoiceId}}"
                                        target="_blank"
                                        ng-class="{disabled:!operation.invoiceId}">
                                    <i class="glyphicon glyphicon-eye-open"></i>
                                </a>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 pull-right">
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
                                       max="{{invoice.summa-invoice.paidAmount}}" min="0">
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-default" ng-click="operation.removeInvoice(invoice.id)"><i
                                        class="glyphicon glyphicon-minus"></i></button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sum" class="control-label col-md-3">Сума погашення<span style="color:red">*</span> (грн.)</label>
                            <div class="col-md-9" id="sum">
                                <input id="sum" type="number" class="form-control form-inline text-right"
                                       ng-value="invoicesSum()" ng-pattern="/^[0-9]+(\.[0-9]{1,2})?$/" step="0.01"
                                       ng-model="operation.sum"
                                       readonly/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3">Доступна сума:</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control form-inline text-right" ng-value="(externalPayment.remainder-operation.sum)<0?0:(externalPayment.remainder-operation.sum).toFixed(2)" readonly/>
                            </div>
                        </div>
                        <span style="color:red">*</span>При спробі погасити більше одного рахунку одночасно, <b><em>сума погашення</em></b>
                        буде спочатку максимально погашувати попередні рахунки починаючи з першого. Якщо на рахунок не буде вистачати доступних коштів,
                        рахунок буде погашено на максимально можливу суму.
                        <br>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <button class="btn btn-default form-control no-blur" ng-click="createOperation()">Погасити рахунок
                                </button>
                            </div>
                            <div class="col-md-4 pull-right">
                                <button class="btn btn-default form-control no-blur" ng-click="cleanUp()">Очистити</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    #invoice option:disabled{
        color: green;
        font-weight: bold;
    }
    option.startPayment{
        color: orangered;
        font-weight: bold;
    }
</style>