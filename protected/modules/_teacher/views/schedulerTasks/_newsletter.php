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

            </td>
        </tr>
        <tr>
            <td>Кому:</td>
            <td>
                <span ng-repeat="item in selectedRecipients">{{item.email}};</span>
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




