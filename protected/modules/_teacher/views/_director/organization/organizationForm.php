<?php
/* @var $scenario */
?>
<div class="panel-body" ng-controller="organizationCtrl">
    <div class="row">
        <div class="formMargin">
            <div class="col-lg-8">
                <form autocomplete="off" ng-submit="sendFormOrganization('<?php echo $scenario ?>');" name="organizationForm"  novalidate>
                    <div class="form-group">
                        <label>Назва*</label>
                        <input name="name" class="form-control" ng-model="organization.name" required maxlength="128" size="50">
                        <div ng-cloak  class="clientValidationError" ng-show="organizationForm['name'].$dirty && organizationForm['name'].$invalid">
                            <span ng-show="organizationForm['name'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" ng-disabled="organizationForm.$invalid">Зберегти
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