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
                uib-typeahead="typeahead as currentProvider.label(typeahead) for typeahead in getTypeahead($viewValue)"
                typeahead-loading="loadingLocations"
                typeahead-no-results="noResults"
                class="form-control">
            <!--                typeahead-on-select="currentProvider.onSelect($item, $model, $label, $event)"-->

        </div>

        <div>
            <div class="form-horizontal">
                <h3>Дані платежу</h3>
                <div class="form-group">
                    <label for="userName" class="control-label col-sm-2">Користувач</label>
                    <div class="col-sm-10">
                        <select class="form-control form-inline" id="userName">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="agreement" class="control-label col-sm-2">Договір</label>
                    <div class="col-sm-10">
                        <select class="form-control form-inline" id="agreement">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="invoice" class="control-label col-sm-2">Рахунок</label>
                    <div class="col-sm-10">
                        <select class="form-control form-inline" id="invoice">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>