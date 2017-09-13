<div class="panel panel-default" ng-controller="crmManagerCtrl">
   <h3>Завдання</h3>
    <ul>
        <li ng-repeat="task in tasks track by $index">
            Змінено завдання: {{task.idTask.name}}, змінено: {{task.idTask.change_date}}
        </li>
    </ul>
</div>