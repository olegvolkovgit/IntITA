<div class="panel" ng-controller="trainerCtrl">
    <div class="panel-body">
        <div class="tab-content">
            <uib-tabset active="active">
                <uib-tab ng-repeat="tab in tabs" heading="{{tab.title}}" ui-sref ="trainer/students.{{tab.route}}" ></uib-tab>
            </uib-tabset>
            <div ui-view="trainerTabs"></div>
        </div>
    </div>
</div>