<ul class="list-inline">
    <li>
        <a type="button" class="btn btn-primary" ng-href="#/accountant/representative">Представники</a>
    </li>
</ul>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="formMargin">
            <form novalidate name="addRepresentativeForm" ng-submit="addRepresentative('<?php echo Yii::app()->createUrl('/_teacher/_accountant/representative/newRepresentative') ?>')">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="" ng-click="isNewRepresentativeOpen = !isNewRepresentativeOpen">
                                Новий представник
                            </a>
                        </div>
                        <div ng-show="!isNewRepresentativeOpen">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Прізвище, ім'я, по-батькові</label>
                                    <input ng-model="newRepresentative" type="text" name="full_name" class="form-control" maxlength="255"
                                           size="50" id="newRepresentative" ng-disabled="oldRepresentative">
                                    <div ng-cloak  class="clientValidationError" ng-show="addRepresentativeForm['newRepresentative'].$dirty && addRepresentativeForm['newRepresentative'].$invalid">
                                        <span ng-show="addRepresentativeForm['newRepresentative'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="" ng-click="isOldRepresentativeOpen = !isOldRepresentativeOpen">
                                Вибрати існуючого представника
                            </a>
                        </div>
                        <div ng-show="isOldRepresentativeOpen">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Представник</label>
                                    <input ng-model="oldRepresentative" id="typeaheadRepresentative" type="text" class="typeahead form-control"
                                           placeholder="виберіть представника" size="90"  ng-disabled="newRepresentative">
                                    <input type="number" hidden="hidden" id="representative" value="0"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Компанія *</label>
                        <input id="typeaheadCompany" type="text" class="typeahead form-control" name="company" ng-model="company"
                               placeholder="виберіть компанію" size="90" required>
                        <input type="number" hidden="hidden" id="companyId" value="0"/>
                        <div ng-cloak  class="clientValidationError" ng-show="addRepresentativeForm['company'].$dirty && addRepresentativeForm['company'].$invalid">
                            <span ng-show="addRepresentativeForm['company'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Посада *</label>
                        <input ng-model="position" type="text" name="position" class="form-control" maxlength="100" required>
                        <div ng-cloak  class="clientValidationError" ng-show="addRepresentativeForm['position'].$dirty && addRepresentativeForm['position'].$invalid">
                            <span ng-show="addRepresentativeForm['position'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Порядок *</label>
                        <input ng-model="order" type="number" name="order" class="form-control" max="99" min="1" required>
                        <div ng-cloak  class="clientValidationError" ng-show="addRepresentativeForm['order'].$dirty && addRepresentativeForm['order'].$invalid">
                            <span ng-show="addRepresentativeForm['order'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                            <span ng-show="addRepresentativeForm['order'].$error.max || addRepresentativeForm['order'].$error.number">Порядок - число від 1 до 99</span>
                        </div>
                    </div>

                    <input type="text" hidden="hidden" id="scenario" value="new"/>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" ng-disabled=addRepresentativeForm.$invalid>Зберегти
                        </button>
                        <a type="reset" class="btn btn-primary" ng-href="#/accountant/representative">Скасувати</a>
                    </div>
            </form>

            <div class="alert alert-info">
                Якщо немає потрібної компанії, потрібно спочатку додати її у формі:
                <a class="alert-link" ng-href="#/accountant/addcompany">Додати компанію</a>.
                <br>
                Список усіх компаній:
                <a class="alert-link" ng-href="#/accountant/company">Компанії</a>.
            </div>
        </div>
    </div>
</div>

<script>
    var representatives = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_accountant/representative/representativeByQuery?query=%QUERY',
            wildcard: '%QUERY',
            filter: function (users) {
                return $jq.map(users.results, function (user) {
                    return {
                        id: user.id,
                        name: user.name
                    };
                });
            }
        }
    });

    representatives.initialize();

    $jq('#typeaheadRepresentative').on('typeahead:selected', function (e, item) {
        $jq("#representative").val(item.id);
    });

    $jq('#typeaheadRepresentative').typeahead(null, {
        name: 'representatives',
        display: 'name',
        limit: 10,
        source: representatives,
        templates: {
            empty: [
                '<div class="empty-message">',
                'немає представників з таким іменем',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'><div class='typeahead_labels'><div class='typeahead_primary'>{{name}}&nbsp;</div></div></div>")
        }
    });

    var companies = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_accountant/company/companiesByQuery?query=%QUERY',
            wildcard: '%QUERY',
            filter: function (companies) {
                return $jq.map(companies.results, function (company) {
                    return {
                        id: company.id,
                        title: company.title,
                        edpnou: company.edpnou
                    };
                });
            }
        }
    });

    companies.initialize();

    $jq('#typeaheadCompany').on('typeahead:selected', function (e, item) {
        $jq("#companyId").val(item.id);
    });

    $jq('#typeaheadCompany').typeahead(null, {
        name: 'companies',
        display: 'title',
        limit: 10,
        source: companies,
        templates: {
            empty: [
                '<div class="empty-message">',
                'немає компаній з такою назвою або ЄДРПОУ',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'><div class='typeahead_labels'><div class='typeahead_primary'>{{title}}&nbsp;</div><div class='typeahead_secondary'>ЄДРПОУ: {{edpnou}}</div></div></div>")
        }
    });
</script>

