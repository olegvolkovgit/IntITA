<a type="button" class="btn btn-primary" ng-href="#/configuration/create_task_type">
    Створити новий тип
</a>
<br>
<br>
<div class="panel panel-default" ng-controller="taskTypesTableCtrl">
    <div ng-repeat="list in model" class="col-sm-12 col-md-12 main-list">
        <div class="panel panel-info">
            <div class="panel-heading header-list">
                <div class="col-md-3 col-sm-3 col-xs-3">Назва укр</div>
                <div class="col-md-3 col-sm-3 col-xs-3">Назва рос</div>
                <div class="col-md-3 col-sm-3 col-xs-3">Назва анг</div>
                <div class="col-md-3 col-sm-3 col-xs-3">П/н</div>
            </div>
            <div class="panel-body">
                <ul class="list-group" dnd-list dnd-drop="callback({targetList: list, targetIndex: index})"
                >
                    <li class="list-group-item" ng-repeat="item in list"
                        dnd-draggable="null" dnd-callback="onDrop(list, $index, targetList, targetIndex)">
                        <div class="col-md-3 col-xs-3">
                            {{item.labelFunc($index)[1].title_ua}}
                        </div>
                        <div class="col-md-3 col-xs-3">
                            {{item.labelFunc($index)[1].title_ru}}
                        </div>
                        <div class="col-md-3 col-xs-3">
                            {{item.labelFunc($index)[1].title_en}}
                        </div>
                        <div class="col-md-3 col-xs-3">
                            {{item.labelFunc($index)[1].order}}
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>