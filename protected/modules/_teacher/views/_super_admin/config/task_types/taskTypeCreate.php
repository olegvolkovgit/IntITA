<div class="panel-body" ng-controller="taskTypesTableCtrl">
    <div class="row">
        <div class="formMargin">
            <div class="col-lg-8">
                <form autocomplete="off" ng-submit="createTaskType();" name="editTaskTypeForm"  novalidate>
                    <div class="form-group">
                        <label>Назва українською*</label>
                        <input name="title_ua" class="form-control" ng-model="taskType.title_ua" required maxlength="128" size="50">
                        <div ng-cloak  class="clientValidationError" ng-show="editTaskTypeForm['title_ua'].$dirty && editTaskTypeForm['title_ua'].$invalid">
                            <span ng-show="editTaskTypeForm['title_ua'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Назва російською*</label>
                        <input name="title_ru" class="form-control" ng-model="taskType.title_ru" required maxlength="128" size="50">
                        <div ng-cloak  class="clientValidationError" ng-show="editTaskTypeForm['title_ru'].$dirty && editTaskTypeForm['title_ru'].$invalid">
                            <span ng-show="editTaskTypeForm['title_ru'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Назва англійською*</label>
                        <input name="title_ua" class="form-control" ng-model="taskType.title_en" required maxlength="128" size="50">
                        <div ng-cloak  class="clientValidationError" ng-show="editTaskTypeForm['title_en'].$dirty && editTaskTypeForm['title_en'].$invalid">
                            <span ng-show="editTaskTypeForm['title_en'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" ng-disabled="editTaskTypeForm.$invalid">Створити
                        </button>
                        <a type="button" class="btn btn-default" ng-click='back()'>
                            Назад
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
