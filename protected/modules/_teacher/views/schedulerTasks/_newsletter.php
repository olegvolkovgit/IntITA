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
                <span ng-show="newsletterType == 'allUsers'">Всі користувачі</span>
                <span ng-show="newsletterType == 'users'">Розсилка по окремих користувачах</span>
                <span ng-show="newsletterType == 'groups'">Розсилка по групах </span>
                <span ng-show="newsletterType == 'roles'">Розсилка по ролях</span>
                <span ng-show="newsletterType == 'subGroups'">Розсилка по підгрупах</span>
            </td>
        </tr>
        <tr>
            <td>Кому:</td>
            <td>
                <span ng-show="newsletterType == 'users'" ng-repeat="item in selectedRecipients">{{item.email}}; </span>
                <span ng-show="newsletterType == 'groups'"  ng-repeat="item in selectedRecipients">{{item.name}}; </span>
                <span ng-show="newsletterType == 'roles'" ng-repeat="item in selectedRecipients">{{item.name}}; </span>
                <span ng-show="newsletterType == 'subGroups'" ng-repeat="item in selectedRecipients">&lt;{{item.groupName}}&gt;{{item.name}}; </span>
                <span ng-show="newsletterType == 'allUsers'">Всі користувачі</span>
            </td>
        </tr>
        <tr>
            <td>Від:</td>
            <td>
                {{emailSelected.email}}
            </td>
        </tr>
        <tr>
            <td>Тема:</td>
            <td>
                {{subject}}
            </td>
        </tr>
        <tr>
            <td>Лист:</td>
            <td ng-bind-html="message">
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




