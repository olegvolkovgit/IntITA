<?php
/* @var $scenario */
?>
<div class="panel-body">
    <div class="row">
        <div class="formMargin">
            <div class="col-lg-8">
                <form ng-submit="sendFormOfflineGroup('<?php echo $scenario ?>');" name="offlineGroupForm"  novalidate>
                    <div class="form-group">
                        <label>Назва*</label>
                        <input name="name" class="form-control" ng-model="group.name" required maxlength="128" size="50">
                        <div ng-cloak  class="clientValidationError" ng-show="offlineGroupForm['name'].$dirty && offlineGroupForm['name'].$invalid">
                            <span ng-show="offlineGroupForm['name'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Дата створення групи*</label>
                        <input type="text" id="start_date" ng-model="group.start_date" name="start_date" ng-pattern="/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])/" style="border-radius: 4px;border: 1px solid #ccc;" size="16" value="" required/>
                        <div ng-cloak  class="clientValidationError" ng-show="offlineGroupForm['start_date'].$dirty && offlineGroupForm['start_date'].$invalid">
                            <span ng-show="offlineGroupForm['start_date'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                            <span ng-show="offlineGroupForm['start_date'].$error.pattern">Введи дату створення групи в форматі рррр-мм-дд</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Спеціалізація*:</label>
                        <select class="form-control" ng-options="item.id as item.specialization for item in specializations"
                                ng-model="selectedSpecialization">
                            <option name="specialization" value="" disabled selected>(Виберіть спеціалізацію)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Куратор (автор чату групи)*:</label>
                        <input name="curator" class="form-control" type="text" ng-model="curatorEntered" ng-model-options="{ debounce: 1000 }"
                               placeholder="Виберіть куратора" required size="50"
                               uib-typeahead="item.nameEmail for item in getCurators($viewValue) | limitTo : 10"
                               typeahead-no-results="curatorNoResults"
                               typeahead-on-select="onSelectCurator($item)"
                               ng-change="reloadCurator()">
                        <div ng-show="curatorNoResults">
                            <i class="glyphicon glyphicon-remove"></i>Куратора не знайдено
                        </div>
                        <div ng-cloak  class="clientValidationError" ng-show="offlineGroupForm['curator'].$dirty && offlineGroupForm['curator'].$invalid">
                            <span ng-show="offlineGroupForm['curator'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Місто*:</label>
                        <input autocomplete="off" name="city" class="form-control" type="text" ng-model="cityEntered" ng-model-options="{ debounce: 1000 }"
                               placeholder="Виберіть місто" required size="50"
                               uib-typeahead="item.title for item in getCities($viewValue) | limitTo : 10"
                               typeahead-no-results="cityNoResults"
                               typeahead-on-select="onSelect($item)"
                               ng-change="reload()">
                        <div ng-show="cityNoResults">
                            <i class="glyphicon glyphicon-remove"></i>Місто не знайдено
                        </div>
                        <div ng-cloak  class="clientValidationError" ng-show="offlineGroupForm['city'].$dirty && offlineGroupForm['city'].$invalid">
                            <span ng-show="offlineGroupForm['city'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" ng-disabled="offlineGroupForm.$invalid || !selectedSpecialization  || !selectedCity || !selectedCurator">Зберегти
                        </button>
                        <a type="button" class="btn btn-default" ng-href="#/supervisor/offlineGroups">
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
</script>