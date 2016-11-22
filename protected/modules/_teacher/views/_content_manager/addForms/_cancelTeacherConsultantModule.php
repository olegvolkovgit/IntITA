<div class="panel panel-default col-md-7">
    <div class="panel-body">
        <div class="form-group">
            <label>Викладач:</label>
            <br>
            <div class="form-group">
                <input type="text" size="135" ng-model="formData.userSelected"
                       ng-model-options="{ debounce: 1000 }" placeholder="Викладач"
                       uib-typeahead="item.email for item in getTeachersConsultant($viewValue)"
                       ng-change="reloadUser()" typeahead-no-results="noResults"
                       typeahead-template-url="customTemplate.html"
                       typeahead-on-select="showModulesByRole('teacher_consultant',$item)" class="form-control" />
                <i ng-show="loadingTeachers" class="glyphicon glyphicon-refresh"></i>
                <div ng-show="noResults">
                    <i class="glyphicon glyphicon-remove"></i> користувача не знайдено
                </div>
            </div>
        </div>
        <div ng-if="userModules">
            <label>Модулі:</label>
            <br>
            <select class="form-control" ng-model="userModule"
                    ng-options="module.id as module.title for module in userModules">
                <option name="module" value="" disabled selected>(Виберіть модуль)</option>
            </select>
            <br>
            <button
                class="btn btn-success"
                ng-click="cancelTeacherRoleAttribute('teacher_consultant','module',selectedUserUnset.id,userModule)">
                Скасувати
            </button>
        </div>
    </div>
</div>