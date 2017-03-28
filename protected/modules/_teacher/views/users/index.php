<div class="panel panel-default" ng-controller="usersTabsCtrl">
    <div class="panel-body">
        <div class="tab-content">
            <uib-tabset active="active">
                <uib-tab ng-repeat="tab in tabs" heading="{{tab.title}} {{tab.count | bracket}}" ui-sref ="users.{{tab.route}}" ></uib-tab>
            </uib-tabset>
            <div ui-view="usersTabs"></div>
        </div>
    </div>
</div>





