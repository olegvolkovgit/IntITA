<?php
/* @var $this MessagesController */
/* @var $model Translate */
?>
<div class="formMargin" ng-controller="interfaceMessagesCtrl">
    <div class="col-md-8">
        <form id="translateForm" method="post" name="translateForm"
              onsubmit="addTranslate('<?php echo Yii::app()->createUrl('/_teacher/_admin/translate/create'); ?>');return false;">
            <div class="form-group">
                <div class="form-group">
                    <label for="id" >ID повідомлення *</label>
                    <input ng-model="message.id" ng-pattern="numbers" type="number" name="id" required min="1" max="2147483647" class="form-control">
                     <span class="errorMessage" ng-show="(translateForm.id.$dirty || submitted) && translateForm.id.$error.required">Обов'язкове поле</span>
                     <span class="errorMessage" ng-show="(translateForm.id.$dirty || submitted) && translateForm.id.$error.pattern">Введіть число</span>
                </div>
                <br>
                <br>

                <div class="form-group">
                    <label for="category">Категорія повідомлення *</label>
                    <input ng-model="message.category" ng-pattern="english" type="text" name="category" maxlength="32" required class="form-control">
                    <span class="errorMessage" ng-show="(translateForm.category.$dirty || submitted) && translateForm.category.$error.required">Обов'язкове поле</span>
                    <span class="errorMessage" ng-show="(translateForm.category.$dirty || submitted) && translateForm.category.$error.pattern">Категорія має бути вказана латинськими літерами</span>
                </div>
                <br>
                <br>

                <div class="form-group">
                    <label for="translateUa">Переклад українською *</label>
                    <textarea ng-model="message.translateUa" name="translateUa" rows="5" required class="form-control"></textarea>
                    <span class="errorMessage" ng-show="(translateForm.translateUa.$dirty || submitted) && translateForm.translateUa.$error.required">Обов'язкове поле</span>
                </div>
                <br>

                <div class="form-group">
                    <label for="translateRu">Переклад російською *</label>
                    <textarea ng-model="message.translateRu" name="translateRu" rows="5" required class="form-control"></textarea>
                    <span class="errorMessage" ng-show="(translateForm.translateRu.$dirty || submitted) && translateForm.translateRu.$error.required">Обов'язкове поле</span>
                </div>
                <br>

                <div class="form-group">
                    <label for="translateEn">Переклад англійською *</label>
                    <textarea ng-model="message.translateEn" name="translateEn" rows="5" required class="form-control"></textarea>
                    <span class="errorMessage" ng-show="(translateForm.translateEn.$dirty || submitted) && translateForm.translateEn.$error.required">Обов'язкове поле</span>
                </div>

                <br>

                <div class="form-group">
                    <label for="comment">Коментар</label>
                    <textarea ng-model="message.comment" name="comment" rows="5" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <br>
                    <input class="btn btn-primary" ng-click="submitForm(translateForm)" value="Додати повідомлення">
                </div>
            </div>
        </form>
    </div>
</div>

