<!--<link href="_content/modal.less" rel="stylesheet/less" type="text/css">-->
<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.5.3/less.min.js"></script>
<div ng-controller="crmTasksCtrl">
    <div class="panel-body">
        <uib-tabset active="0">
            <uib-tab index="0" heading="Мої" ui-sref="tasks.my"></uib-tab>
            <uib-tab index="1" heading="Допомагаю" ui-sref="tasks.helps"></uib-tab>
            <uib-tab index="2" heading="Доручив" ui-sref="tasks.entrust"></uib-tab>
            <uib-tab index="3" heading="Спостерігаю" ui-sref="tasks.watch"></uib-tab>
        </uib-tabset>
        <br>
        <div class="row text-right">
            <button ng-click="openModal('newTask')" type="button" class="btn btn-primary">Додати завдання</button>
        </div>
        <br>
        <hr>
        <div ui-view="usersTasks"></div>
    </div>
</div>

<modal id="newTask">
    <div class="modal">
        <div class="modal-body">
            <h1>Нове завдання</h1>
            <p>
                <input type="text" placeholder="Введіть назву завдання" ng-model="task.name" />
            </p>
            <p>
                <button type="button" class="btn btn-success">Поставити завдання</button>
                <button type="button" class="btn btn-default" ng-click="closeModal('newTask');">Відміна</button>
            </p>
        </div>
    </div>
    <div class="modal-background"></div>
</modal>