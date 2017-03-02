<?php
/* @var $invoices array
 * @var $invoice Invoice
 */
?>
<div class="col-lg-12" ng-controller="invoicesCtrl">
    <div class="panel panel-default">
        <div class="panel-body">
            <invoice-table></invoice-table>
        </div>
        <a type="button" class="btn btn-default" ng-click='back()'>
            Назад
        </a>
    </div>
</div>
