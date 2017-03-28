<div class="panel-body" ng-controller="teachersCtrl">
    <div class="row">
        <div class="formMargin">
            <div class="col-lg-8">
                <form ng-submit="sendTeacherForm('create');" name="teacherForm"  novalidate>
                    <div class="form-group">
                            <div class="form-group">
                                <label>
                                    <strong>Користувач *</strong>
                                </label>
                                <input type="text" size="50" ng-model="userSelected"  ng-model-options="{ debounce: 1000 }"
                                       placeholder="користувач" uib-typeahead="item.email for item in getUsersNotTeacher($viewValue) | limitTo : 10"
                                       typeahead-no-results="noResults"  typeahead-template-url="customTemplate.html"
                                       typeahead-on-select="onSelectUser($item)" ng-change="reloadUser()" class="form-control" autofocus required/>
                                <div ng-show="noResults">
                                    <i class="glyphicon glyphicon-remove"></i> користувача не знайдено
                                </div>
                            </div>
                    </div>
<!--                    <div class="form-group">-->
<!--                        <label>Ім’я (англійською) *</label>-->
<!--                        <input name="first_name_en" class="form-control" ng-pattern="/^([a-zA-Z0-9_ ])+$/" ng-model="teacher.first_name_en" maxlength="35" size="55" required />-->
<!--                        <div ng-cloak  class="clientValidationError" ng-show="teacherForm['first_name_en'].$dirty && teacherForm['first_name_en'].$invalid">-->
<!--                            <span ng-show="teacherForm['first_name_en'].$error.required">--><?php //echo Yii::t('error','0268') ?><!--</span>-->
<!--                            <span ng-show="teacherForm['first_name_en'].$error.pattern">Недопустимі символи!</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <label>По-батькові (англійською) *</label>-->
<!--                        <input name="middle_name_en" class="form-control" ng-pattern="/^([a-zA-Z0-9_ ])+$/" ng-model="teacher.middle_name_en" maxlength="35" size="55" required />-->
<!--                        <div ng-cloak  class="clientValidationError" ng-show="teacherForm['middle_name_en'].$dirty && teacherForm['middle_name_en'].$invalid">-->
<!--                            <span ng-show="teacherForm['middle_name_en'].$error.required">--><?php //echo Yii::t('error','0268') ?><!--</span>-->
<!--                            <span ng-show="teacherForm['middle_name_en'].$error.pattern">Недопустимі символи!</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <label>Прізвище (англійською) *</label>-->
<!--                        <input name="last_name_en" class="form-control" ng-pattern="/^([a-zA-Z0-9_ ])+$/" ng-model="teacher.last_name_en" maxlength="35" size="55" required />-->
<!--                        <div ng-cloak  class="clientValidationError" ng-show="teacherForm['last_name_en'].$dirty && teacherForm['last_name_en'].$invalid">-->
<!--                            <span ng-show="teacherForm['last_name_en'].$error.required">--><?php //echo Yii::t('error','0268') ?><!--</span>-->
<!--                            <span ng-show="teacherForm['last_name_en'].$error.pattern">Недопустимі символи!</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="form-group">-->
<!--                        <label>Ім’я (російською) *</label>-->
<!--                        <input name="first_name_ru" class="form-control" ng-pattern="/^([а-яА-ЯёЁ ])+$/u" ng-model="teacher.first_name_ru" maxlength="35" size="55" required />-->
<!--                        <div ng-cloak  class="clientValidationError" ng-show="teacherForm['first_name_ru'].$dirty && teacherForm['first_name_ru'].$invalid">-->
<!--                            <span ng-show="teacherForm['first_name_ru'].$error.required">--><?php //echo Yii::t('error','0268') ?><!--</span>-->
<!--                            <span ng-show="teacherForm['first_name_ru'].$error.pattern">Недопустимі символи!</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <label>По-батькові (російською) *</label>-->
<!--                        <input name="middle_name_ru" class="form-control" ng-pattern="/^([а-яА-ЯёЁ ])+$/u" ng-model="teacher.middle_name_ru" maxlength="35" size="55" required />-->
<!--                        <div ng-cloak  class="clientValidationError" ng-show="teacherForm['middle_name_ru'].$dirty && teacherForm['middle_name_ru'].$invalid">-->
<!--                            <span ng-show="teacherForm['middle_name_ru'].$error.required">--><?php //echo Yii::t('error','0268') ?><!--</span>-->
<!--                            <span ng-show="teacherForm['middle_name_ru'].$error.pattern">Недопустимі символи!</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <label>Прізвище (російською) *</label>-->
<!--                        <input name="last_name_ru" class="form-control" ng-pattern="/^([а-яА-ЯёЁ ])+$/u" ng-model="teacher.last_name_ru" maxlength="35" size="55" required />-->
<!--                        <div ng-cloak  class="clientValidationError" ng-show="teacherForm['last_name_ru'].$dirty && teacherForm['last_name_ru'].$invalid">-->
<!--                            <span ng-show="teacherForm['last_name_ru'].$error.required">--><?php //echo Yii::t('error','0268') ?><!--</span>-->
<!--                            <span ng-show="teacherForm['last_name_ru'].$error.pattern">Недопустимі символи!</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="form-group">-->
<!--                        <label>Текст профілю (перша частина)</label>-->
<!--                        <textarea name="profile_text_first" ng-model="teacher.profile_text_first" rows="6" cols="50" class="form-control" style="resize: vertical">-->
<!---->
<!--                        </textarea>-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <label>Короткий опис (сторінка викладачів)</label>-->
<!--                        <textarea name="profile_text_short" ng-model="teacher.profile_text_short" rows="6" cols="50" class="form-control" style="resize: vertical">-->
<!---->
<!--                        </textarea>-->
<!--                    </div>-->
<!---->
<!--                    <div class="form-group">-->
<!--                        <label>Текст профілю (друга частина)</label>-->
<!--                        <textarea name="profile_text_last" ng-model="teacher.profile_text_last" rows="6" cols="50" class="form-control" style="resize: vertical">-->
<!---->
<!--                        </textarea>-->
<!--                    </div>-->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" ng-disabled="teacherForm.$invalid">Зберегти
                        </button>
                        <a href="" type="button" class="btn btn-default" ng-click="back()">
                            Назад
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    if (scenario == "definedUser") {
        $jq('#typeahead').val('<?=(isset($predefinedUser)) ? addslashes(CHtml::decode($predefinedUser->userNameWithEmail())) : "";?>');
        $jq("#userIdHidden").val('<?=(isset($predefinedUser)) ? $predefinedUser->id : 0;?>');
    }
</script>