<div teachermode1="<?php echo Yii::app()->user->model->isСoworker() ?>" ng-controller="crmTasksCtrl" >
    <div style="float: right; margin: 2px">
        <button ng-click="openCrmModal('lg', null, true)" type="button" class="btn btn-primary">Додати завдання</button>
    </div>
    <ul class="nav nav-tabs" ng-class="{'nav-stacked': vertical, 'nav-justified': justified}" >
        <li ng-class="[{active: board==1, disabled: disabled}, classes]" class="uib-tab nav-item ng-scope ng-isolate-scope" index="0" heading="Kanban" >
            <a style="padding:4px" href="" ng-click="board=1" class="nav-link ng-binding" >Kanban</a>
        </li>
        <li ng-class="[{active: board==2, disabled: disabled}, classes]" class="uib-tab nav-item ng-scope ng-isolate-scope" index="1" heading="Table" >
            <a style="padding:4px" href="" ng-click="board=2" class="nav-link ng-binding" >Table</a>
        </li>
    </ul>

    <div class="panel-body">
        <uib-tabset active="active">
            <uib-tab ng-repeat="tab in tabs" heading="{{tab.title}} {{tab.count | bracket}}" ui-sref ="tasks.{{tab.route}}" ></uib-tab>
        </uib-tabset>
        <div ui-view="usersTasks"></div>
    </div>
</div>