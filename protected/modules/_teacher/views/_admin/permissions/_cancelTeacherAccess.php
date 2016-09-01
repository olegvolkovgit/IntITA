<br>
<div class="panel panel-default col-md-7">
    <div class="panel-body">
            <div class="form-group">
                <label>Викладач:</label>
                <br>
                <div class="form-group">
                    <input type="text" size="135" ng-model="teacherSelected" ng-model-options="{ debounce: 1000 }" placeholder="Викладач" uib-typeahead="item.email for item in getTeachers($viewValue)" typeahead-no-results="noResultsCancelTeacherAttr"  typeahead-template-url="customTemplate.html" typeahead-on-select="showModules($item,'teacher')" class="form-control" />
                    <i ng-show="loadingTeachers2" class="glyphicon glyphicon-refresh"></i>
                    <div ng-show="noResultsCancelTeacherAttr">
                        <i class="glyphicon glyphicon-remove"></i> Викладача не знайдено
                    </div>
                </div>
            </div>
            <div ng-if="teacherModules">
                <label>Модулі:</label>
                <br>
                <select class="form-control" name="modules" ng-model="teacherModule">
                            <option ng-repeat="module in teacherModules"  value={{module.id}}>{{module.title}}</option>
                </select>
                <br>
                <button class="btn btn-outline btn-warning" ng-click="cancelPermission('moduleAuchtor',teacherModule)">Скасувати</button>
            </div>
    </div>
</div>