<div style="width:50%">
    <div ng-controller="operationCtrl">
        <h2 class="m-b-10">Додати нову проплату</h2>

        <div class="m-b-10">
            <span>Пошук по </span>
            <div class="btn-group">
                <label ng-repeat="provider in typeaheadProviders track by $index"
                       class="btn btn-default"
                       ng-model="$parent.providerId"
                       uib-btn-radio="'{{$index}}'"
                       ng-class="{active:$index === $parent.providerId}">
                    {{provider.name}}
                </label>
            </div>
        </div>

        <div class="input-group m-b-10">
            <span ng-show="!loadingLocations && !noResults" class="input-group-addon" id="gl_icon"><i
                    class="glyphicon glyphicon-pencil"></i></span>
            <span ng-show="loadingLocations" class="input-group-addon" id="gl_icon"><i
                    class="glyphicon glyphicon-refresh"></i></span>
            <span ng-show="noResults" class="input-group-addon" id="gl_icon"><i class="glyphicon glyphicon-remove"></i></span>
            <input
                aria-describedby="gl_icon"
                type="text"
                ng-model="selected"
                uib-typeahead="typeahead[currentProvider.searchField] for typeahead in getTypeahead($viewValue)"
                typeahead-loading="loadingLocations"
                typeahead-no-results="noResults"
                typeahead-on-select="currentProvider.onSelect($item, $model, $label, $event)"
                class="form-control">
        </div>

        <div ng-show="agreementData.id">
            <h3>Інформація по обраному договору</h3>
            <div class="m-b-10"><span>Договір №{{agreementData.number}} від {{agreementData.create_date}}</span></div>
            <div class="m-b-10"><span>Користувач {{agreementData.user_id.fullName}} </span></div>
            <div class="m-b-10">
                <button class="btn btn-default">Перегдянути детальну інформацію по договору</button>
            </div>
            <h3>Рахунки до договору: </h3>
            <select class="form-control m-b-10">
                <option ng-repeat="invoice in invoices.rows" value="{{invoice.id}}" ng-selected="invoice.id === invoiceData.id">
                    {{invoice.number}} від {{invoice.date_created}}
                </option>
            </select>
        </div>

    </div>
</div>