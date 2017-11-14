<?php
/* @var $scenario */
?>
<div ng-controller="offlineStudentSubgroupCtrl">
    <div class="panel-body">
        <ul class="list-inline">
            <li>
                <a type="button" class="btn btn-primary" ng-href="#/supervisor/offlineStudents">
                    Офлайн студенти
                </a>
            </li>
            <li ng-if="defaultStudent">
                <a type="button" class="btn btn-primary" ng-href="#/users/profile/{{defaultStudent}}">
                    Профіль студента
                </a>
            </li>
            <?php if($scenario=='update') { ?>
            <li>
                <a ng-if=!end_date type="button" class="btn btn-primary" 
                   ng-click="cancelStudentFromSubgroup(selectedUser.id,selectedSubgroup.id)">
                    Виключити студента з підгрупи
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="formMargin">
                <div class="col-lg-8">
                    <form autocomplete="off" name="studentSubgroup"  novalidate
                          ng-submit="sendOfflineStudentSubgroupForm('<?php echo $scenario ?>',selectedUser.id,selectedSubgroup.id,
                          start_date,graduate_date, studentModelId, services)">
                        <div class="form-group">
                            <label>Студент*:</label>
                            <input type="text" name="student" size="50" ng-model="userSelected"  ng-model-options="{ debounce: 1000 }"
                                   placeholder="Студент" uib-typeahead="item.email for item in getStudents($viewValue) | limitTo : 10"
                                   typeahead-no-results="noResultsStudent"  typeahead-template-url="customTemplate.html"
                                   typeahead-on-select="onSelectUser($item)" ng-change="reloadUser()" class="form-control"
                                   ng-disabled="defaultStudent" required/>
                            <div ng-show="noResultsStudent">
                                <i class="glyphicon glyphicon-remove"></i> студента не знайдено
                            </div>
                            <div ng-cloak  class="clientValidationError" ng-show="studentSubgroup['student'].$dirty && studentSubgroup['student'].$invalid">
                                <span ng-show="studentSubgroup['student'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Група*:</label>
                            <input autocomplete="off" maxlength="128" size="50" name="group" class="form-control"
                                   type="text" ng-model="groupSelected" ng-model-options="{ debounce: 1000 }"
                                   placeholder="Виберіть групу" required
                                   uib-typeahead="item.name for item in getGroups($viewValue) | limitTo : 10"
                                   typeahead-no-results="groupNoResults"
                                   typeahead-on-select="onSelectGroup($item)"
                                   ng-change="reloadGroup()" ng-disabled="defaultGroup">
                            <div ng-show="groupNoResults">
                                <i class="glyphicon glyphicon-remove"></i> групу не знайдено
                            </div>
                            <div ng-cloak  class="clientValidationError" ng-show="studentSubgroup['group'].$dirty && studentSubgroup['group'].$invalid">
                                <span ng-show="studentSubgroup['group'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Підгрупа*</label>
                            <select ng-disabled="end_date || defaultSubgroup" class="form-control"
                                    ng-options="subgroup as subgroup.name for subgroup in subgroupsList track by subgroup.id"
                                    ng-model="selectedSubgroup" required>
                                <option value="" disabled selected>(Виберіть підгрупу)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Дата додавання студента в групу*</label>
                            <input ng-disabled=end_date type="text" id="start_date" ng-model="start_date" name="start_date"
                                   ng-pattern="/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])/" style="border-radius: 4px;border: 1px solid #ccc;" size="16" value="" required/>
                            <div ng-cloak  class="clientValidationError" ng-show="studentSubgroup['start_date'].$dirty && studentSubgroup['start_date'].$invalid">
                                <span ng-show="studentSubgroup['start_date'].$error.required"><?php echo Yii::t('error','0268') ?></span>
                                <span ng-show="studentSubgroup['start_date'].$error.pattern">Введи дату додавання студента в групу в форматі рррр-мм-дд</span>
                            </div>
                        </div>
                        <?php if($scenario=='update') { ?>
                        <div class="form-group">
                            <label>Дата випуску:</label>
                            <input ng-disabled=end_date type="text" id="graduate_date" ng-model="graduate_date" name="graduate_date"
                                   ng-pattern="/[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])/" style="border-radius: 4px;border: 1px solid #ccc;" size="16" value=""/>
                            <br>
                            <div ng-if="!studentModel.graduateDate">
                                *При встановленні дати випуску, відмідьте сервіси та встановіть рейтинг, по яким випустився студент
                                <br>
                                <label ng-if="services.courses.length">Курси:</label>
                                <div ng-if="services.courses.length" ng-repeat="course in services.courses track by $index">
                                    <span>{{course.title_ua}}</span>
                                    <input ng-disabled=end_date type="number" ng-model="course.rat" min="1" max="10" style="border-radius: 4px;border: 1px solid #ccc;" value=""/> (рейтинг)
                                </div>
                                <label ng-if="services.modules.length">Модулі:</label>
                                <div ng-if="services.modules.length" ng-repeat="module in services.modules track by $index">
                                    <span>{{module.title_ua}}</span>
                                    <input ng-disabled=end_date type="number" ng-model="module.rat" min="1" max="10" style="border-radius: 4px;border: 1px solid #ccc;" value=""/> (рейтинг)
                                </div>
                            </div>
                            <div ng-if="studentModel.graduateDate">
                                <br>
                                <a type="button" class="btn btn-default" ng-click="graduateLink(studentModel.id)" target="_blank">
                                    Посилання на редагування випускника
                                </a>
                            </div>
                            <div ng-cloak  class="clientValidationError" ng-show="studentSubgroup['graduate_date'].$dirty && studentSubgroup['graduate_date'].$invalid">
                                <span ng-show="studentSubgroup['graduate_date'].$error.pattern">Введи дату випуску студента в форматі рррр-мм-дд</span>
                            </div>
                        </div>
                        <div class="form-group" ng-if=end_date>
                            <label>Дата скасування:</label>
                            <input class="form-control" ng-model="end_date" maxlength="128" size="50" disabled>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <button  ng-if=!end_date type="submit" class="btn btn-primary" ng-disabled="studentSubgroup.$invalid">Зберегти
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
</div>
<script>
    $jq(document).ready(function () {
        $jq("#start_date").datepicker(lang);
        $jq("#graduate_date").datepicker(lang);
    });
</script>