<div class="panel-body" ng-controller="teachersCtrl">
    <div class="row">
        <div class="formMargin">
            <div class="col-lg-8">
                <form ng-submit="createTeacher();" name="teacherForm"  novalidate>
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