<div teachermode1="<?php echo Yii::app()->user->model->isСoworker() ?>" ng-controller="crmTasksCtrl">
    <div ng-controller="crmManagerCtrl">
        <uib-tabset active="active">
            <uib-tab ng-repeat="event in events" heading="{{event.title}} {{event.count | bracket}}" ui-sref ="tasksManager.{{event.route}}" ></uib-tab>
        </uib-tabset>
        <div ui-view="managerEvents"></div>
    </div>
</div>