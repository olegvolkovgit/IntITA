<div class="panel panel-primary" ng-controller="adminRoleCtrl">
    <div class="panel-body">
        <form autocomplete="off" ng-submit="assignLocalRole(selectedUser.id,selectedRole)" name="addLocalRoleForm"  novalidate>
            <div class="form-group">
                <label>Роль*:</label>
                <select class="form-control" ng-options="item.role as item.name for item in roles" ng-change="clearInputs()" ng-model="selectedRole">
                    <option name="role" value="" disabled selected>(Виберіть роль)</option>
                </select>
            </div>
            <div class="form-group">
                <label>
                    <strong>Співробітник*:</strong>
                </label>
                <input type="text" size="135" ng-model="userSelected"  ng-model-options="{ debounce: 1000 }"
                       placeholder="Співробітник" uib-typeahead="item.email for item in getUsersForRole(selectedRole,$viewValue, '<?php echo Yii::app()->user->model->getCurrentOrganization()->id ?>') | limitTo : 10"
                       typeahead-no-results="noResults"  typeahead-template-url="customTemplate.html"
                       typeahead-on-select="onSelectUser($item)" ng-change="reloadUser()" class="form-control"
                       ng-disabled="!selectedRole" name="user"/>
                <div ng-show="noResults">
                    <i class="glyphicon glyphicon-remove"></i>співробітника не знайдено
                </div>
            </div>

            <button type="submit" class="btn btn-primary" ng-disabled="!selectedRole || !selectedUser">
                Призначити роль
            </button>
            <a type="button" class="btn btn-default" ng-click='back()'>
                Назад
            </a>
        </form>
    </div>
</div>