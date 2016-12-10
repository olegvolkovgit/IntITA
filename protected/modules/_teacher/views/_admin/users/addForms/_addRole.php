<div class="panel panel-primary" ng-controller="roleCtrl">
    <div class="panel-body">
        <div class="form-group">
            <label>
                <strong>Співробітник:</strong>
            </label>
            <input type="text" size="135" ng-model="userSelected"  ng-model-options="{ debounce: 1000 }"
                   placeholder="Співробітник" uib-typeahead="item.email for item in getUsersForRole('<?php echo $role ?>',$viewValue) | limitTo : 10"
                   typeahead-no-results="noResults"  typeahead-template-url="customTemplate.html"
                   typeahead-on-select="onSelectUser($item)" ng-change="reloadUser()" class="form-control" />
            <div ng-show="noResults">
                <i class="glyphicon glyphicon-remove"></i> співробітника не знайдено
            </div>
            <em>Зверніть увагу, що деяких користувачів може не бути в списку. 
                В списку немає користувачів, які не є співробітниками.</em>
        </div>
        
        <button class="btn btn-primary" ng-click="assignRole(selectedUser.id,'<?php echo $role ?>');">
            Призначити роль '<?php echo $title ?>'
        </button>
        <a type="button" class="btn btn-default" ng-click='back()'>
            Назад
        </a>
    </div>
</div>