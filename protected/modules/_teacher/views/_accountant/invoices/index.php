<?php
/* @var $invoices array
 * @var $invoice Invoice
 */
?>
<div class="col-lg-12" ng-controller="invoicesCtrl">
    <div class="panel panel-default">
        <div class="panel-body">
            <table ng-table="tableParams" class="table table-bordered table-striped table-condensed">
                <tr ng-repeat="row in $data track by row.id">
                    <td data-title="'Номер рахунку'">{{row.number}}</td>
                    <td data-title="'Договір'">{{row.agreement_id}}</td>
                    <td data-title="'Дата заведення'">{{row.date_created}}</td>
                    <td data-title="'Дата сплати'">{{row.payment_date}}</td>
                    <td data-title="'Користувач'">{{row.user_created}}</td>
                    <td data-title="'Оплатити до'">{{row.payment_date}}</td>
                    <td data-title="'Дійсний до'">{{row.pay_date}}</td>
                    <td data-title="'Відмінив'">{{row.user_cancelled}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
