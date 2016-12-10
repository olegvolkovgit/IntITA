<div class="panel-body">
    <div class="row">
        <div class="formMargin">
            <div class="col-lg-8">
                <form autocomplete="off" ng-submit="editSpecialization();" name="editSpecializationForm"  novalidate>
                    <div class="form-group">
                        <label>Назва*</label>
                        <input name="name" class="form-control" ng-model="specialization.name" required maxlength="128" size="50">
                        <div ng-cloak  class="clientValidationError" ng-show="editSpecializationForm['name'].$dirty && editSpecializationForm['name'].$invalid">
                            <span ng-show="editSpecializationForm['name'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" ng-disabled="editSpecializationForm.$invalid">Зберегти
                        </button>
                        <a type="button" class="btn btn-default" ng-href="#/supervisor/specializations">
                            Назад
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
