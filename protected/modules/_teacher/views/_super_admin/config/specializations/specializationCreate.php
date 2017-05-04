<div class="panel-body" ng-controller="specializationsTableCtrl">
    <div class="row">
        <div class="formMargin">
            <div class="col-lg-8">
                <form autocomplete="off" ng-submit="createSpecialization();" name="editSpecializationForm"  novalidate>
                    <div class="form-group">
                        <label>Назва укр.*</label>
                        <input name="title_ua" class="form-control" ng-model="specialization.title_ua" required maxlength="128" size="50">
                        <div ng-cloak  class="clientValidationError" ng-show="editSpecializationForm['title_ua'].$dirty && editSpecializationForm['title_ua'].$invalid">
                            <span ng-show="editSpecializationForm['title_ua'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Назва рос.*</label>
                        <input name="title_ru" class="form-control" ng-model="specialization.title_ru" required maxlength="128" size="50">
                        <div ng-cloak  class="clientValidationError" ng-show="editSpecializationForm['title_ru'].$dirty && editSpecializationForm['title_ru'].$invalid">
                            <span ng-show="editSpecializationForm['title_ru'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Назва англ.*</label>
                        <input name="title_en" class="form-control" ng-model="specialization.title_en" required maxlength="128" size="50">
                        <div ng-cloak  class="clientValidationError" ng-show="editSpecializationForm['title_en'].$dirty && editSpecializationForm['title_en'].$invalid">
                            <span ng-show="editSpecializationForm['title_en'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" ng-disabled="editSpecializationForm.$invalid">Створити
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
