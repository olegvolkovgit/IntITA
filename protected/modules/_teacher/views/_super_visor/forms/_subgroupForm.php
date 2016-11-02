<?php
/* @var $scenario */
?>
<div class="panel-body">
    <div class="row">
        <div class="formMargin">
            <div class="col-lg-8">
                <form ng-submit="sendFormSubgroup('<?php echo $scenario ?>');" name="subgroupForm"  novalidate>
                    <div class="form-group">
                        <label>Група:</label>
                        <input class="form-control" ng-model="group.name" required maxlength="128" size="50" disabled>
                    </div>
                    <div class="form-group">
                        <label>Назва*</label>
                        <input class="form-control" ng-model="subgroup.name" required maxlength="128" size="50">
                        <div ng-cloak  class="clientValidationError" ng-show="subgroupForm['name'].$dirty && subgroupForm['name'].$invalid">
                            <span ng-show="subgroupForm['name'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Інформація(розклад)</label>
                        <input name="data" class="form-control" ng-model="subgroup.data" size="128">
                    </div>
                    <div class="form-group">
                        <label>Куратор (автор чату підгрупи)*:</label>
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
                        <button type="submit" class="btn btn-primary" ng-disabled="subgroupForm.$invalid  || !selectedCurator">Зберегти
                        </button>
                        <a type="button" class="btn btn-default" ng-click="goBack();" href="">
                            Назад
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
