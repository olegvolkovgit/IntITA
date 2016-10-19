<div class="panel-body">
    <div class="row">
        <div class="formMargin">
            <div class="col-lg-8">
                <form ng-submit="createOfflineGroup();" name="addOfflineGroupForm"  novalidate>
                    <div class="form-group">
                        <label>Назва*</label>
                        <input name="name" class="form-control" ng-model="name" required maxlength="128" size="50">
                        <div ng-cloak  class="clientValidationError" ng-show="addOfflineGroupForm['name'].$dirty && addOfflineGroupForm['name'].$invalid">
                            <span ng-show="addOfflineGroupForm['name'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Дата створення групи*</label>
                        <input type="text" id="start_date" ng-model="startDate" name="start_date" ng-pattern="/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])/" style="border-radius: 4px;border: 1px solid #ccc;" size="16" value="" required/>
                        <div ng-cloak  class="clientValidationError" ng-show="addOfflineGroupForm['start_date'].$dirty && addOfflineGroupForm['start_date'].$invalid">
                            <span ng-show="addOfflineGroupForm['start_date'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                            <span ng-show="addOfflineGroupForm['start_date'].$error.pattern">Введи дату створення групи в форматі рррр-мм-дд</span>
                        </div>
                    </div>
                    Спеціалізація*<br>
                    <div class="form-group">
                        <select class="form-control" ng-options="item as item.specialization for item in specializations  track by item.id" ng-model="selectedSpecialization">
                            <option name="specialization" value="" disabled selected>(Виберіть спеціалізацію)</option>
                        </select>
                    </div>
                    Місто*<br>
                    <div class="form-group">
                        <input id="typeaheadCity" type="text" class="typeahead form-control" ng-model="city" name="city"
                               placeholder="виберіть місто зі списку" size="90" maxlength="255" required>
                        <input type="number" hidden="hidden" id="city" value="0"/>
                        <div ng-cloak  class="clientValidationError" ng-show="addOfflineGroupForm['city'].$dirty && addOfflineGroupForm['city'].$invalid">
                            <span ng-show="addOfflineGroupForm['city'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" ng-disabled="addOfflineGroupForm.$invalid || !selectedSpecialization">Зберегти
                        </button>
                        <a type="button" class="btn btn-default" ng-href="#/offline_groups">
                            Назад
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $jq(document).ready(function () {
        $jq("#start_date").datepicker(lang);
    });

    var cities = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: basePath + '/_teacher/_super_visor/superVisor/citiesByQuery?query=%QUERY',
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

    $jq('#typeaheadCity').on('typeahead:selected', function (e, item) {
        $jq("#city").val(item.id);
    });

    $jq('#typeaheadCity').typeahead(null, {
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