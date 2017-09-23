<div teachermode1="<?php echo Yii::app()->user->model->isСoworker() ?>" ng-controller="crmTasksCtrl" >
    <div style="float: right; margin: 2px">
        <button ng-click="openModal('lg')" type="button" class="btn btn-primary">Додати завдання</button>
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

    <modal id="newTask">
        <div class="modal">
            <script type="text/ng-template" id="crmModalContent.html">
                <div class="modal-body">
                    <crm-task data-ckeditor-options="editorOptionsCrm" task="crmTask" callback-fn="loadTasks(tasksType)"></crm-task>
                    <br>
                    <p style="clear: both">
                        <button type="button" ng-if="!crmTask.id || (crmTask.id && crmTask.id_state!=4) && (crmTask.created_by==currentUser || canEditCrmTasks)" class="btn btn-success" ng-click="sendTask(crmTask)" ng-disabled="isDisabled" >
                            {{crmTask.id?'Зберегти':'Поставити завдання'}}
                        </button>
                        <button type="button" class="btn btn-default" ng-click="closeModal();">Відміна</button>
                    </p>
                </div>
            </script>
        </div>
        <div class="modal-background"></div>
    </modal>


</div>