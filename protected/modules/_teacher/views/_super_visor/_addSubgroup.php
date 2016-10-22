<div class="panel-body">
    <div class="row">
        <div class="formMargin">
            <div class="col-lg-8">
                <form ng-submit="addSubgroup();" name="addSubgroupForm"  novalidate>
                    <div class="form-group">
                        <label>Назва*</label>
                        <input name="name" class="form-control" ng-model="name" required maxlength="128" size="50">
                        <div ng-cloak  class="clientValidationError" ng-show="addSubgroupForm['name'].$dirty && addSubgroupForm['name'].$invalid">
                            <span ng-show="addSubgroupForm['name'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Інформація(розклад)</label>
                        <input name="data" class="form-control" ng-model="data" size="128">
                    </div>
                    <div class="form-group">
                        <label>Група:</label>
                        <input class="form-control" ng-model="group.name" required maxlength="128" size="50" disabled>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" ng-disabled="addSubgroupForm.$invalid">Зберегти
                        </button>
                        <a type="button" class="btn btn-default" ng-href="#/supervisor/offlineGroup/{{groupId}}">
                            Назад
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>