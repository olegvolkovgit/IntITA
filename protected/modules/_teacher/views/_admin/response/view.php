<?php
/* @var $this ResponseController */
/* @var $model Response */
?>

<link href="<?php echo StaticFilesHelper::fullPathTo('css', '_teacher/graduate.css'); ?>" rel="stylesheet">

<div class="col-md-9" ng-controller="responseModelCtrl" id="responseView">
    <div ng-cloak>
        <ul class="list-inline">
            <li>
                <button type="button" class="btn btn-primary" ng-click="changeView('response')">
                    Відгуки про викладачів</button>
            </li>
            <li>
                <button type="button" class="btn btn-primary" ng-click="changeView('response/edit/'+response.id)">
                    Редагувати</button>
            </li>
            <li>
                <button type="button" class="btn btn-primary" ng-click="deleteResponse(response.id)">
                    Видалити</button>
            </li>
            <li>
                <button type="button" class="btn btn-success" ng-click="changeResponseStatus(response.id,response.is_checked==1?'hide':'publish')">
                    {{response.is_checked==1? "Приховати" : "Опублікувати"}}</button>
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
                <li class="list-group-item"><span class="view-label">Статус: </span>{{response.is_checked==1 ? "опубліковано" : "прихований"}}</li>
            </ul>
        </div>
    </div>
</div>