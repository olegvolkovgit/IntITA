<div teachermode1="<?php echo Yii::app()->user->model->isСoworker() ?>" ng-controller="crmTaskCtrl" >
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/tasks/executant">
                Завдання
            </a>
        </li>
    </ul>
    <crm-task
            data-ckeditor-options="editorOptionsCrm"
            task-id=currentTaskId
            modal=false
            current-user=currentUser
            roles-can-edit-crm-tasks=rolesCanEditCrmTasks
            teacher-mode=teacherMode
            role-id=roleId
            templates-path={{pathToCrmTemplates}}
            callback-fn="loadTasks(tasksType)">
    </crm-task>
</div>