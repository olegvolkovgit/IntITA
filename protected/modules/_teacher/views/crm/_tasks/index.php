<div ng-controller="crmTasksCtrl">
    <input type="radio" ng-model="board" value="1"><label>Kanban</label>
    <input type="radio" ng-model="board" value="2"><label>Table</label>

    <div class="panel-body">
        <uib-tabset active="active">
            <uib-tab ng-repeat="tab in tabs" heading="{{tab.title}} {{tab.count | bracket}}" ui-sref ="tasks.{{tab.route}}" ></uib-tab>
        </uib-tabset>
        <br>
        <div class="row text-right">
            <button ng-click="openModal('newTask')" type="button" class="btn btn-primary">Додати завдання</button>
        </div>
        <br>
        <hr>
        <div ui-view="usersTasks"></div>
    </div>

    <modal id="newTask">
        <div class="modal">
            <div class="modal-body">
                <crm-task data-ckeditor-options="editorOptionsCrm" task="crmTask" producer="producer" callback-fn="loadTasks(tasksType)"></crm-task>
                <br>
                <p style="clear: both">
                    <button type="button" ng-if="!crmTask.id || (crmTask.id && crmTask.id_state!=4) && crmTask.created_by==currentUser" class="btn btn-success" ng-click="sendTask(crmTask,'newTask')" ng-disabled="isDisabled" >
                        {{crmTask.id?'Редагувати':'Поставити завдання'}}
                    </button>
                    <button type="button" class="btn btn-default" ng-click="closeModal('newTask');">Відміна</button>
                </p>
            </div>
        </div>
        <div class="modal-background"></div>
    </modal>
</div>

<style>
    .kanban_default_corner_inner + div{
        display: none;
    }
</style>