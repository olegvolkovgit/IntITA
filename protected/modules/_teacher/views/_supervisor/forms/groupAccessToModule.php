<div class="panel-body" ng-controller="groupAccessCtrl">
    <div class="row">
        <div class="formMargin">
            <div class="col-lg-8">
                <form autocomplete="off" ng-submit="sendGroupAccessToContent('<?php echo $scenario ?>',selectedGroup.id, selectedContent.id, end_date, 'module');" name="groupAccessForm" novalidate>
                    <div class="form-group">
                        <label>Група*:</label>
                        <input autocomplete="off" name="group" class="form-control" type="text" ng-model="groupSelected" ng-model-options="{ debounce: 1000 }"
                               placeholder="Виберіть групу" required size="50"
                               uib-typeahead="item.name for item in getGroups($viewValue) | limitTo : 10"
                               typeahead-no-results="groupNoResults"
                               typeahead-on-select="onSelectGroup($item)"
                               ng-change="reloadGroup()" ng-disabled="defaultGroup">
                        <div ng-show="groupNoResults">
                            <i class="glyphicon glyphicon-remove"></i> групу не знайдено
                        </div>
                        <div ng-cloak  class="clientValidationError" ng-show="groupAccessForm['group'].$dirty && groupAccessForm['group'].$invalid">
                            <span ng-show="groupAccessForm['group'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Модуль*:</label>
                        <input autocomplete="off" type="text" name="module" size="50" ng-model="serviceSelected" ng-model-options="{ debounce: 1000 }"
                               placeholder="Назва модуля" uib-typeahead="item.title for item in getModules($viewValue) | limitTo : 10"
                               typeahead-no-results="noResultsModule"  typeahead-on-select="onSelectService($item)"
                               ng-change="reloadService()" class="form-control" ng-disabled="defaultService"/>
                        <div ng-show="noResultsModule">
                            <i class="glyphicon glyphicon-remove"></i> модуль не знайдено
                        </div>
                        <div ng-cloak  class="clientValidationError" ng-show="groupAccessForm['module'].$dirty && groupAccessForm['module'].$invalid">
                            <span ng-show="groupAccessForm['module'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Закінчення надання прав*</label>
                        <input type="text" id="end_date" ng-init="end_date='2099-12-31'" ng-model="end_date" name="end_date"
                               ng-pattern="/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])/"
                               style="border-radius: 4px;border: 1px solid #ccc;" size="16" value="" required/>
                        <div ng-cloak  class="clientValidationError" ng-show="groupAccessForm['end_date'].$dirty && groupAccessForm['end_date'].$invalid">
                            <span ng-show="groupAccessForm['end_date'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                            <span ng-show="groupAccessForm['end_date'].$error.pattern">Введи дату надання прав в форматі рррр-мм-дд</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" ng-disabled="groupAccessForm.$invalid">Зберегти
                        </button>
                        <a ng-if="defaultService" type="button" class="btn btn-danger"
                           ng-click="cancelGroupAccess(defaultGroup, defaultService)" href="">
                            Скасувати доступ
                        </a>
                        <a type="button" class="btn btn-default" ng-click="back();" href="">
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
        $jq("#end_date").datepicker(lang);
    });
</script>