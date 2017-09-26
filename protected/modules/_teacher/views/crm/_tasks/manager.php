<div ng-controller="crmTasksCtrl">
    <div class="panel panel-default" ng-controller="crmManagerCtrl">
        <ul style="list-style: none;padding:5px;">
            <li ng-repeat="task in tasks track by $index">
                <h3 style="text-align: center; font-weight: bold" ng-if="newTaskEvents>0 && $index==0">Нові події</h3>
                <h3 style="text-align: center; font-weight: bold" ng-if="$index==newTaskEvents">Переглянуті події</h3>
                <div ng-if="task.event=='task'">
                    Користувач <a href="#/users/profile/{{task.idTask.created_by}}" target="_blank">{{task.idTask.createdBy.fullName}}</a>{{!task.idTask.change_date?' створив завдання: ':' відредагував завдання: '}}
                    <a href="" ng-click="getTask(task.idTask.id)">{{task.idTask.name}}</a>, {{task.idTask.change_date?task.idTask.change_date:task.idTask.created_date}}
                    <hr>
                </div>
                <div ng-if="task.event=='comment'">
                    Користувач <a href="#/users/profile/{{task.id_user}}" target="_blank">{{task.idUser.fullName}}</a> додав коментар  "<b><em ng-bind-html="task.message | htmlToPlaintext | limitTo:50"></em></b>" до завдання
                    <a href="" ng-click="getTask(task.idTask.id)">{{task.idTask.name}}</a>, {{task.create_date}}
                    <hr>
                </div>
                <div ng-if="task.event=='role'">
                    Користувач <a href="#/users/profile/{{task.assigned_by}}" target="_blank">{{task.assignedBy.fullName}}</a> {{!task.cancelled_date?' призначив вам роль ':' скасував у вас роль '}}
                    "<b><em>{{task.role0.description}}</em></b>" у завданні <a ng-href="" ng-click="getTask(task.id_task)">{{task.idTask.name}}</a>, {{task.cancelled_date?task.cancelled_date:task.assigned_date}}
                    <hr>
                </div>
                <div ng-if="task.event=='state'">
                    Користувач <a ng-href="#/users/profile/{{task.id_user}}" target="_blank">{{task.idUser.fullName}}</a> перевів завдання
                    <a href="" ng-click="getTask(task.id_task)">{{task.idTask.name}}</a> у стан "<b><em>{{task.idState.description}}</em></b>", {{task.change_date}}
                    <hr>
                </div>
            </li>
        </ul>
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