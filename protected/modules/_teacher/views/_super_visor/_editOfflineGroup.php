<div class="panel-body">
    <div class="row">
        <div class="formMargin">
            <div class="col-lg-8">
                <form ng-submit="editOfflineGroup();" name="addOfflineGroupForm"  novalidate>
                    <div class="form-group">
                        <label>Назва*</label>
                        <input name="name" class="form-control" ng-model="group.name" required maxlength="128" size="50">
                        <div ng-cloak  class="clientValidationError" ng-show="addOfflineGroupForm['name'].$dirty && addOfflineGroupForm['name'].$invalid">
                            <span ng-show="addOfflineGroupForm['name'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Дата створення групи*</label>
                        <input type="text" id="start_date" ng-model="group.start_date" name="start_date" ng-pattern="/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])/" style="border-radius: 4px;border: 1px solid #ccc;" size="16" value="" required/>
                        <div ng-cloak  class="clientValidationError" ng-show="addOfflineGroupForm['start_date'].$dirty && addOfflineGroupForm['start_date'].$invalid">
                            <span ng-show="addOfflineGroupForm['start_date'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                            <span ng-show="addOfflineGroupForm['start_date'].$error.pattern">Введи дату створення групи в форматі рррр-мм-дд</span>
                        </div>
                    </div>
                    Спеціалізація*<br>
                    <div class="form-group">
                        <select class="form-control"
                                ng-options="option.id as option.specialization for option in specializations"
                                ng-model="selectedSpecialization" >
                            <option name="specialization" value="" disabled selected>(Виберіть спеціалізацію)</option>
                        </select>
                    </div>
<!--                    Місто*<br>-->
<!--                    <div class="form-group">-->
<!--                        <input id="typeaheadCity" type="text" class="typeahead form-control" ng-model="city" name="city"-->
<!--                               placeholder="виберіть місто зі списку" size="90" maxlength="255" required>-->
<!--                        <input type="number" hidden="hidden" id="city" value="0"/>-->
<!--                        <div ng-cloak  class="clientValidationError" ng-show="addOfflineGroupForm['city'].$dirty && addOfflineGroupForm['city'].$invalid">-->
<!--                            <span ng-show="addOfflineGroupForm['city'].$error.required">--><?php //echo Yii::t('error','0268') ?><!--</span>-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" ng-disabled="addOfflineGroupForm.$invalid || !selectedSpecialization">Зберегти
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
