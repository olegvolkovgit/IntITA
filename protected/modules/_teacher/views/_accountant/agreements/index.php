<?php
/* @var $agreements array
 * @var $agreement UserAgreements
 */
?>
<div class="col-lg-12" ng-controller="agreementsCtrl">
    <div class="panel panel-default">
        <div class="panel-body">
            <table ng-table="tableParams" class="table table-bordered table-striped table-condensed">
                <tr ng-repeat="row in $data track by row.id">
                    <td data-title="'Номер'"><a href="#" ng-click="showAgreement(row.id)">{{row.number}}</a></td>
                    <td data-title="'Користувач'">{{row.user_id.fullName}}</td>
                    <td data-title="'Дата створення'">{{row.create_date}}</td>
                    <td data-title="'Дата підтвердження'">{{row.approval_date}}</td>
                    <td data-title="'Підтверджено користувачем'">{{row.approval_user.fullName}}</td>
                    <td data-title="'Схема оплати'">{{row.payment_schema.name}}</td>
                    <td data-title="'Управління'">
                        <button type="button" ng-if="!row.approval_date" class="btn btn-success" ng-click="confirm(row.id)">Підтвердити</button>
                        <button type="button" ng-if="row.approval_date" class="btn btn-danger" ng-click="cancel(row.id)">Скасувати</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>