<div class="panel panel-primary" ng-controller="roleCtrl">
    <div class="panel-body">
        <div class="form-group">
            <label>
                <strong>Користувач:</strong>
            </label>
            <input type="text" size="135" ng-model="userSelected"  ng-model-options="{ debounce: 1000 }"
                   placeholder="Користувач" uib-typeahead="item.email for item in getUsersForRole('<?php echo $role ?>',$viewValue) | limitTo : 10"
                   typeahead-no-results="noResults"  typeahead-template-url="customTemplate.html"
                   typeahead-on-select="onSelectUser($item)" ng-change="reloadUser()" class="form-control" />
            <div ng-show="noResults">
                <i class="glyphicon glyphicon-remove"></i> користувача не знайдено
            </div>
        </div>
        
        <button class="btn btn-primary" ng-click="assignRoleByDirector(selectedUser.id,'<?php echo $role ?>');">
            Призначити роль '<?php echo $title ?>'
        </button>
        <a type="button" class="btn btn-default" ng-click='back()'>
            Назад
        </a>
    </div>
</div>