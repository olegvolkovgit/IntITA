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
                    <td data-title="'Номер'">{{row.number}}</td>
                    <td data-title="'Користувач'">{{row.user_id}}</td>
                    <td data-title="'Дата створення'">{{row.create_date}}</td>
                    <td data-title="'Дата підтвердження'">{{row.approval_date}}</td>
                    <td data-title="'Підтверджено користувачем'">{{row.approval_user}}</td>
                    <td data-title="'Схема оплати'">{{row.payment_schema}}</td>
                    <td data-title="'Управління'">{{1}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>