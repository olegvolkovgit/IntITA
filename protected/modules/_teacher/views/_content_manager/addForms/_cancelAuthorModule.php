<div class="panel panel-default col-md-7">
    <div class="panel-body">
        <div class="form-group">
            <label>Автор контента:</label>
            <br>
            <div class="form-group">
                <input type="text" size="135" ng-model="formData.userSelected"
                       ng-model-options="{ debounce: 1000 }" placeholder="Автор контента"
                       uib-typeahead="item.email for item in getAuthors($viewValue)"
                       ng-change="reloadUserUnset()" typeahead-no-results="noResultsUnset"
                       typeahead-template-url="customTemplate.html"
                       typeahead-on-select="showModulesByRole('author',$item)" class="form-control" />
                <i ng-show="loadingTeachers" class="glyphicon glyphicon-refresh"></i>
                <div ng-show="noResultsUnset">
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
                ng-click="cancelTeacherRoleAttribute('author','module',selectedUserUnset.id,userModule)">
                Скасувати
            </button>
        </div>
    </div>
</div>