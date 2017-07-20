<?php
/**
 * Created by PhpStorm.
 * User: adm
 * Date: 13.11.2016
 * Time: 22:43
 */
?>
<div ng-controller="newsletterCtrl">

<div class="panel panel-primary" >

    <div class="panel-heading">
        Перегляд електронного листа
    </div>

    <table class="table table-hover">
        <tbody>
        <tr>
            <td width="30%">Тип розсилки:</td>
            <td>
                <span ng-show="model.newsletter.type == 'allUsers'">Всі користувачі</span>
                <span ng-show="model.newsletter.type == 'users'">Розсилка по окремих користувачах</span>
                <span ng-show="model.newsletter.type == 'groups'">Розсилка по групах </span>
                <span ng-show="model.newsletter.type == 'roles'">Розсилка по ролях</span>
                <span ng-show="model.newsletter.type == 'subGroups'">Розсилка по підгрупах</span>
                <span ng-show="model.newsletter.type == 'emailsFromDatabase'">Розсилка по базі email</span>
            </td>
        </tr>
        <tr ng-hide="model.newsletter.type == 'allUsers'">
            <td>Кому:</td>
            <td ng-cloak>
<!--                <span>{{model.newsletter.recipients}}; </span>-->
                <span ng-show="model.newsletter.type == 'users'" ng-repeat="item in model.newsletter.recipients"><{{item.name}}>{{item.email}}; </span>
                <span ng-show="model.newsletter.type == 'groups'"  ng-repeat="item in selectedRecipients">{{item.name}}; </span>
                <span ng-show="model.newsletter.type == 'roles'" ng-repeat="item in selectedRecipients">{{item.name}}; </span>
                <span ng-show="model.newsletter.type == 'subGroups'" ng-repeat="item in selectedRecipients">&lt;{{item.groupName}}&gt;{{item.name}}; </span>
                <span ng-show="model.newsletter.type == 'emailsFromDatabase'" ng-repeat="item in selectedRecipients">{{item.name}}; </span>
                <span ng-show="model.newsletter.type == 'allUsers'">Всі користувачі</span>
            </td>
        </tr>
        <tr>
            <td>Від:</td>
            <td>
                {{model.newsletter.newsletter_email}}
            </td>
        </tr>
        <tr>
            <td>Тема:</td>
            <td>
                {{model.newsletter.subject}}
            </td>
        </tr>
        <tr>
            <td>Лист:</td>
            <td ng-bind-html="model.newsletter.text">
            </td>
        </tr>
        <tr>
            <td>Час початку:</td>
            <td>
                {{model.start_time}}
            </td>
        </tr>
        <tr>
            <td>Час закінчення:</td>
            <td >
                {{model.end_time}}
            </td>
        </tr>
        <tr>
            <td>Створено користувачем:</td>
            <td>
                {{model.fullName}}
            </td>
        </tr>
        <tr>
            <td>Помилки:</td>
            <td>
                {{model.error}}
            </td>
        </tr>
        </tbody>
    </table>


</div>

<button class="btn btn-primary" ng-click="editNewsletter(model.id)">Редагувати/повторити розсилку</button>
</div>




