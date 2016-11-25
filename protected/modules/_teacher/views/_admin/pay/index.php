<?php
/* @var $this PayController */
?>
<?php if (!empty($cancelMode)) {
    $moduleAction = 'cancelModule';
    $courseAction = 'cancelCourse';
    $buttonModuleName = 'Скасувати доступ до модуля';
    $buttonCourseName = 'Скасувати доступ до курсу';
    $fieldsetModule = $buttonModuleName;
    $fieldsetCourse = $buttonCourseName;
} else {
    $moduleAction = 'payModule';
    $courseAction = 'payCourse';
    $buttonModuleName = Yii::t('payments', '0599');
    $buttonCourseName = Yii::t('payments', '0604');
    $fieldsetModule = Yii::t('payments', '0593');
    $fieldsetCourse = Yii::t('payments', '0600');
}
?>
<div ng-controller="payCtrl">
    <div class="panel panel-default col-md-7">
        <div class="panel-body">
            <div id="addAccessModule">
                <div id="findModule" class="form-group">
                        <div>
                            <label>Користувач:</label>
                            <br>
                            <input type="text" size="135" ng-model="selectedUser" ng-model-options="{ debounce: 1000 }"
                                   placeholder="Користувач" uib-typeahead="item.email for item in getUsers($viewValue) | limitTo : 10"
                                   typeahead-no-results="noResultsUser"  typeahead-template-url="customTemplate.html"
                                   typeahead-on-select="selectUser($item)" ng-change="reloadUser()" class="form-control" />
                            <i ng-show="loadingUsers" class="glyphicon glyphicon-refresh"></i>
                            <div ng-show="noResultsUser">
                                <i class="glyphicon glyphicon-remove"></i> користувача не знайдено
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default col-md-7">
        <div class="panel-body">
                    <label>
                        <strong><?php echo $fieldsetModule; ?>:</strong>
                    </label>

                    <div class="form-group">
                        <input type="text" size="135" ng-model="selectedModule" ng-model-options="{ debounce: 1000 }"
                               placeholder="Назва модуля" uib-typeahead="item.title for item in getModules($viewValue) | limitTo : 10"
                               typeahead-no-results="noResultsModule"  typeahead-on-select="selectModule($item)"
                               ng-change="reloadModule()" class="form-control" />
                        <i ng-show="loadingModules" class="glyphicon glyphicon-refresh"></i>
                        <div ng-show="noResultsModule">
                            <i class="glyphicon glyphicon-remove"></i> модуль не знайдено
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" ng-click="actionModule('<?=$moduleAction?>')"><?php echo $buttonModuleName; ?></button>
                    </div>
        </div>
    </div>

    <div class="panel panel-default col-md-7">
        <div class="panel-body">
            <div id="addAccessModule">
                        <label>
                            <strong><?php echo $fieldsetCourse ?>:</strong>
                        </label>
                        <div class="form-group">
                            <input type="text" size="135" ng-model="selectedCourse" ng-model-options="{ debounce: 1000 }"
                                   placeholder="Назва кусру" uib-typeahead="item.title for item in getCourses($viewValue) | limitTo : 10"
                                   typeahead-no-results="noResultsCourse"  typeahead-on-select="selectCourse($item)"
                                   ng-change="reloadCourse()" class="form-control" />
                            <i ng-show="loadingCourses" class="glyphicon glyphicon-refresh"></i>
                            <div ng-show="noResultsCourse">
                                <i class="glyphicon glyphicon-remove"></i> курс не знайдено
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" ng-click="actionCourse('<?=$courseAction?>')"><?php echo $buttonCourseName; ?></button>
            </div>
        </div>
    </div>
</div>


