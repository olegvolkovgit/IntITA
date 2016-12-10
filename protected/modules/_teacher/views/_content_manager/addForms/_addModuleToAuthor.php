<div class="panel panel-default col-md-7">
    <div class="panel-body">
        <div class="form-group">
            <label>
                <strong>Автор контента:</strong>
            </label>
            <input type="text" size="135" ng-model="userSelected"  ng-model-options="{ debounce: 1000 }"
                   placeholder="Автор контента" uib-typeahead="item.email for item in getAuthors($viewValue) | limitTo : 10"
                   typeahead-no-results="noResultsSet"  typeahead-template-url="customTemplate.html"
                   typeahead-on-select="onSelectUserSet($item)" ng-change="reloadUserSet()" class="form-control" />
            <i ng-show="loadingTeachers" class="glyphicon glyphicon-refresh"></i>
            <div ng-show="noResultsSet">
                <i class="glyphicon glyphicon-remove"></i> користувача не знайдено
            </div>
        </div>
        <div class="form-group">
            <label>
                <strong>Модуль:</strong>
            </label>
            <input type="text" size="135" ng-model="formData.moduleSelected" ng-model-options="{ debounce: 1000 }"
                   placeholder="Модуль" uib-typeahead="item.title for item in getModules($viewValue) | limitTo:10"
                   typeahead-no-results="moduleNoResults" typeahead-on-select="onSelectModule($item)"
                   ng-change="reloadModule()" class="form-control" ng-disabled="defaultModule"/>
            <i ng-show="loadingModules" class="glyphicon glyphicon-refresh"></i>
            <div ng-show="moduleNoResults">
                <i class="glyphicon glyphicon-remove"></i> модуль не знайдено
            </div>
        </div>
        <br>
        <div class="form-group">
            <button type="button" class="btn btn-success" ng-click="setTeacherRoleAttribute('author','module',selectedUserSet.id,selectedModule.id)">Призначити автора модуля</button>
            <a type="button" class="btn btn-default" ng-click='back()'>
                Назад
            </a>
        </div>
    </div>
    <div>
        <div class="alert alert-info">
            <?php if (Yii::app()->user->model->isAdmin()) { ?>
                Автором модуля можна призначити лише співробітника з ролю 'автор контента'.
                Якщо потрібного користувача немає в списку, то додати автора можна на сторінці
                <a class="alert-link" ng-href="#/admin/users/addrole/author">
                    додати автора контента
                </a>.
            <?php } else { ?>
                Призначити автором можна тільки співробітника з ролю 'автор контента'.
            <?php } ?>
        </div>
    </div>
</div>