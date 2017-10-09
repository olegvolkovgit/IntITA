<style>
    table.table-condensed{
        table-layout: inherit;
    }
</style>
<div ng-controller="trainerCtrl">
    <uib-tabset active="active">
        <uib-tab ng-repeat="tab in tabs" heading="{{tab.title}}" ui-sref ="trainer/students.{{tab.route}}" ></uib-tab>
    </uib-tabset>
    <div ui-view="trainerTabs"></div>
</div>