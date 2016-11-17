<?php
/* @var $this MailTemplatesController */
/* @var $data MailTemplates */
?>

<div class="view" ng-controller="mailTemplatesCtrl">
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/newsletter/template">Повернутись</a>
        </li>
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/newsletter/template/edit/{{mailTemplateModel.id}}">Редагувати</a>
        </li>
    </ul>
    <br>
    <div class="panel panel-primary">
        <div class="panel-body">
            <div class="form-group">
                <label>Назва шаблону</label>
                <br>
                {{mailTemplateModel.title}}
                <br>
            </div>
            <div class="form-group">
                <label>Тема електронного листа</label>
                <br>
                <div ng-bind-html="mailTemplateModel.subject"></div>
                <br>
            </div>
            <div class="form-group">
                <label>Текст електронного листа</label>
                <br>
                <div ng-bind-html="mailTemplateModel.text"></div>
                <br>
            </div>
            <div class="form-group">
                <label>Активний</label>
                <br>
                <span ng-show="mailTemplateModel.active">Так</span>
                <span ng-show="!mailTemplateModel.active">Ні</span>
                <br>
            </div>
        </div>

    </div>


</div>