<ul class="list-inline">
    <li>
        <a type="button" class="btn btn-primary" ng-href="#/accountant/company">Компанії</a>
    </li>
</ul>
<div class="panel-body">
    <div class="row">
        <div class="formMargin">
            <div class="col-lg-8">
                <form ng-submit="addCompany('<?php echo Yii::app()->createUrl('/_teacher/_accountant/company/newCompany') ?>')"
                      name="addCompanyForm"  novalidate>
                    <div class="form-group">
                        <label>Назва*</label>
                        <input name="title" class="form-control" ng-model="title"
                               ng-pattern="/^[=а-яА-Яa-zA-Z0-9ЄєІіЇїҐґ.,\/:;`'’&@_(){}\[\]%#№|\\\\?! ~<>*+-]+$/u"
                               required maxlength="255" size="50">
                        <div ng-cloak  class="clientValidationError" ng-show="addCompanyForm['title'].$dirty && addCompanyForm['title'].$invalid">
                            <span ng-show="addCompanyForm['title'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                            <span ng-show="addCompanyForm['title'].$error.pattern"><?php echo Yii::t('error','0429') ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>ЄДРПОУ*</label>
                        <input name="edpnou" maxlength="8" ng-pattern="/[0-9]{8}/" ng-model="edpnou"
                               class="form-control" placeholder="8-ми значне число" required>
                        <div ng-cloak  class="clientValidationError" ng-show="addCompanyForm['edpnou'].$dirty && addCompanyForm['edpnou'].$invalid">
                            <span ng-show="addCompanyForm['edpnou'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                            <span ng-show="addCompanyForm['edpnou'].$error.pattern">Введи 8-ми значне число</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Дата видачі ЄДРПОУ*</label>
                        <input type="text" ng-model="edpnou_issue_date" name="edpnou_issue_date" ng-pattern="/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])/" style="border-radius: 4px;border: 1px solid #ccc;" size="16" id="edpnou_issue_date" value="" required/>
                        <div ng-cloak  class="clientValidationError" ng-show="addCompanyForm['edpnou_issue_date'].$dirty && addCompanyForm['edpnou_issue_date'].$invalid">
                            <span ng-show="addCompanyForm['edpnou_issue_date'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                            <span ng-show="addCompanyForm['edpnou_issue_date'].$error.pattern">Введи дату видачі ЄДРПОУ в форматі рррр-мм-дд</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Свідоцтво платника ПДВ*</label>
                        <input maxlength="12" ng-pattern="/^[=[0-9]+$/" name="certificate_of_vat"
                               ng-model="certificate_of_vat" placeholder="Номер платника ПДВ" class="form-control" required>
                        <div ng-cloak  class="clientValidationError" ng-show="addCompanyForm['certificate_of_vat'].$dirty && addCompanyForm['certificate_of_vat'].$invalid">
                            <span ng-show="addCompanyForm['certificate_of_vat'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                            <span ng-show="addCompanyForm['certificate_of_vat'].$error.pattern">Введи номер платника ПДВ</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Дата видачі свідоцтва платника ПДВ*</label>
                        <input style="border-radius: 4px;border: 1px solid #ccc;" size="16" type="text"  ng-model="certificate_of_vat_issue_date" name="certificate_of_vat_issue_date"
                               ng-pattern="/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])/" id="certificate_of_vat_issue_date" value="" required/>
                        <div ng-cloak  class="clientValidationError" ng-show="addCompanyForm['certificate_of_vat_issue_date'].$dirty && addCompanyForm['certificate_of_vat_issue_date'].$invalid">
                            <span ng-show="addCompanyForm['certificate_of_vat_issue_date'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                            <span ng-show="addCompanyForm['certificate_of_vat_issue_date'].$error.pattern">Введи номер платника ПДВ</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Свідоцтво платника податку*</label>
                        <input maxlength="12" ng-pattern="/^[=[0-9]+$/" ng-model="tax_certificate" name="tax_certificate" class="form-control"
                               placeholder="Номер платника податку" required>
                        <div ng-cloak  class="clientValidationError" ng-show="addCompanyForm['tax_certificate'].$dirty && addCompanyForm['tax_certificate'].$invalid">
                            <span ng-show="addCompanyForm['tax_certificate'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                            <span ng-show="addCompanyForm['tax_certificate'].$error.pattern">Введи номер платника податку</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Дата видачі свідоцтва платника податку*</label>
                        <input style="border-radius: 4px;border: 1px solid #ccc;" size="16" type="text" ng-pattern="/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])/"
                               ng-model="tax_certificate_issue_date" name="tax_certificate_issue_date" id="tax_certificate_issue_date" value="" required/>
                        <div ng-cloak  class="clientValidationError" ng-show="addCompanyForm['tax_certificate_issue_date'].$dirty && addCompanyForm['tax_certificate_issue_date'].$invalid">
                            <span ng-show="addCompanyForm['tax_certificate_issue_date'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                            <span ng-show="addCompanyForm['tax_certificate_issue_date'].$error.pattern">Введи номер платника податку</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Місто (юридична адреса)*</label>
                        <input id="typeaheadCityLegal" type="text" class="typeahead form-control" ng-model="cityLegal" name="cityLegal"
                               placeholder="виберіть місто" size="90" maxlength="255" required>
                        <input type="number" hidden="hidden" id="cityLegal" value="0"/>
                        <div ng-cloak  class="clientValidationError" ng-show="addCompanyForm['cityLegal'].$dirty && addCompanyForm['cityLegal'].$invalid">
                            <span ng-show="addCompanyForm['cityLegal'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Юридична адреса*</label>
                        <input name="legal_address" ng-model="legal_address" class="form-control" required maxlength="255" size="50">
                        <div ng-cloak  class="clientValidationError" ng-show="addCompanyForm['legal_address'].$dirty && addCompanyForm['legal_address'].$invalid">
                            <span ng-show="addCompanyForm['legal_address'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Місто (фактична адреса)*</label>
                        <input id="typeaheadCityActual" type="text" ng-model="cityActual" class="typeahead form-control" name="cityActual"
                               placeholder="виберіть місто" size="90" maxlength="255" required>
                        <input type="number" hidden="hidden" id="cityActual" value="0"/>
                        <div ng-cloak  class="clientValidationError" ng-show="addCompanyForm['cityActual'].$dirty && addCompanyForm['cityActual'].$invalid">
                            <span ng-show="addCompanyForm['cityActual'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Фактична адреса*</label>
                        <input name="actual_address" ng-model="actual_address" class="form-control" required maxlength="255" size="50">
                        <div ng-cloak  class="clientValidationError" ng-show="addCompanyForm['actual_address'].$dirty && addCompanyForm['actual_address'].$invalid">
                            <span ng-show="addCompanyForm['actual_address'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" ng-disabled=addCompanyForm.$invalid>Зберегти
                        </button>
                        <a type="reset" class="btn btn-primary" ng-href="#/accountant/company">Скасувати</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $jq(document).ready(function () {
        $jq("#edpnou_issue_date").datepicker(lang);
        $jq("#certificate_of_vat_issue_date").datepicker(lang);
        $jq("#tax_certificate_issue_date").datepicker(lang);
    });


    var cities = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_accountant/company/citiesByQuery?query=%QUERY',
            wildcard: '%QUERY',
            filter: function (cities) {
                return $jq.map(cities.results, function (city) {
                    return {
                        id: city.id,
                        title: city.title,
                        country: city.country
                    };
                });
            }
        }
    });

    cities.initialize();

    $jq('#typeaheadCityLegal').on('typeahead:selected', function (e, item) {
        $jq("#cityLegal").val(item.id);
    });

    $jq('#typeaheadCityActual').on('typeahead:selected', function (e, item) {
        $jq("#cityActual").val(item.id);
    });

    $jq('#typeaheadCityLegal, #typeaheadCityActual').typeahead(null, {
        name: 'cities',
        display: 'title',
        limit: 10,
        source: cities,
        templates: {
            empty: [
                '<div class="empty-message">',
                'немає міст з такою назвою',
                '</div>'
            ].join('\n'),
            suggestion: Handlebars.compile("<div class='typeahead_wrapper'><div class='typeahead_labels'><div class='typeahead_primary'>{{title}}&nbsp;</div><div class='typeahead_secondary'>{{country}}</div></div></div>")
        }
    });
</script>
