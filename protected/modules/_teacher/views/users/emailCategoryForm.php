<?php
/* @var $scenario */
?>
<div class="panel-body" ng-controller="emailCategoryCtrl">
    <div class="row">
        <div class="formMargin">
            <div class="col-lg-8">
                <form autocomplete="off" ng-submit="sendEmailCategory('<?php echo $scenario ?>')" name="emailCategoryForm"  novalidate>
                    <div class="form-group">
                        <label>Назва*</label>
                        <input name="title" class="form-control" ng-model="emailCategory.title" required maxlength="128" size="50">
                        <div ng-cloak  class="clientValidationError" ng-show="emailCategoryForm['title'].$dirty && emailCategoryForm['title'].$invalid">
                            <span ng-show="emailCategoryForm['title'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" ng-disabled="emailCategoryForm.$invalid">Зберегти
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
