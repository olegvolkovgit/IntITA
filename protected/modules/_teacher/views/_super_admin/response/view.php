<link href="<?php echo StaticFilesHelper::fullPathTo('css', '_teacher/graduate.css'); ?>" rel="stylesheet">

<div ng-controller="responseModelCtrl" id="responseView">
    <div ng-cloak>
        <ul class="list-inline">
            <li>
                <a type="button" class="btn btn-primary" ng-href='#/response'>
                    Відгуки про викладачів
                </a>
            </li>
            <li>
                <a type="button" class="btn btn-primary" ng-href="#/response/edit/{{response.id}}">
                    Редагувати
                </a>
            </li>
            <li>
                <a type="button" class="btn btn-primary" ng-click="deleteResponse(response.id)">
                    Видалити
                </a>
            </li>
            <li ng-if="response.is_checked!=0">
                <a type="button" class="btn btn-success" ng-click="changeResponseStatus(response.id,'hide')">
                    Приховати
                </a>
            </li>
            <li ng-if="response.is_checked!=1">
                <a type="button" class="btn btn-success" ng-click="changeResponseStatus(response.id,'publish')">
                    Опублікувати
                </a>
            </li>
        </ul>
        <div class="list-group">
            <ul class="list-group">
                <li class="list-group-item list-group-item-info"><h4 class="list-group-item-heading">Від кого: </h4>
                    {{response.user_name}}</li>
                <li class="list-group-item"><span class="view-label">Дата: </span>{{response.date}}</li>
                <li class="list-group-item"><span class="view-label">Відгук: </span>{{response.text}}</li>
                <li class="list-group-item"><span class="view-label">Оцінка: </span>{{response.rate}}</li>
                <li class="list-group-item"><span class="view-label">Знання: </span>{{response.knowledge}}</li>
                <li class="list-group-item"><span class="view-label">Поведінка: </span>{{response.behavior}}</li>
                <li class="list-group-item"><span class="view-label">Мотивація: </span>{{response.motivation}}</li>
                <li class="list-group-item"><span class="view-label">Статус: </span>
                    <span ng-if="response.is_checked==1">опублікованно</span>
                    <span ng-if="response.is_checked==0">приховано</span>
                    <span ng-if="!response.is_checked">не перевірено</span>
                </li>
            </ul>
        </div>
    </div>
</div>