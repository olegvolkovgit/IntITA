<div class="panel panel-primary" ng-controller="roleCtrl">
    <div class="panel-body">
        <form autocomplete="off" ng-submit="assignRoleByDirector(selectedUser.id,'<?php echo $role ?>', selectedOrganization);" name="addLocalRoleForm"  novalidate>
            <div class="form-group">
                <label>Організація*:</label>
                <select class="form-control" ng-options="item.id as item.name for item in organizations" ng-change="clearInputs()" ng-model="selectedOrganization">
                    <option name="organization" value="" disabled selected>(Виберіть організацію)</option>
                </select>
            </div>
            <div class="form-group">
                <label>
                    <strong>Користувач*:</strong>
                </label>
                <input type="text" size="135" ng-model="userSelected"  ng-model-options="{ debounce: 1000 }"
                       placeholder="Користувач" uib-typeahead="item.email for item in getUsersForRole('<?php echo $role ?>',$viewValue, selectedOrganization) | limitTo : 10"
                       typeahead-no-results="noResults"  typeahead-template-url="customTemplate.html"
                       typeahead-on-select="onSelectUser($item)" ng-change="reloadUser()" class="form-control"
                       ng-disabled="!selectedOrganization" name="user"/>
                <div ng-show="noResults">
                    <i class="glyphicon glyphicon-remove"></i>користувача не знайдено
                </div>
            </div>

            <button type="submit" class="btn btn-primary" ng-disabled="!selectedOrganization || !selectedUser">
                Призначити роль '<?php echo $title ?>'
            </button>
            <a type="button" class="btn btn-default" ng-click='back()'>
                Назад
            </a>
        </form>
    </div>
</div>