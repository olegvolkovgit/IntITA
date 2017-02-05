<?php
/* @var $agreement UserAgreements */
?>
<div class="titleAgreement">
    <h4>Рахунки до сплати за договором №<?php echo $agreement->number; ?> від
        <?= date("d.m.Y", strtotime($agreement->create_date));?></h4>
    <h4><?php echo $agreement->service->description; ?></h4>
    <h4>Вартість: <?php echo $agreement->summa==0?'безкоштовно':$agreement->summa.' грн.'; ?></h4>
    <h4>Форма
        навчання: <?= AbstractIntITAService::getServiceById($agreement->service->service_id)->getEducationForm()->title_ua ?></h4>
    <h4>Схема проплат: <?= PaymentScheme::getPaymentName($agreement); ?></h4>
</div>
<div class="panel panel-default">
    <div class="panel-body" >
        <table ng-table="invoicesTable" class="table table-striped table-bordered table-hover">
            <tr ng-repeat="row in $data track by $index">
                <td data-title="'Рахунок'">
                    <a href="{{invoiceUrl}}{{row.id}}">Рахунок № {{row.number}}</a>
                </td>
                <td data-title="'Загальна сума, грн.'">{{row.summa}}</td>
                <td data-title="'Сплачено, грн.'">{{row.paidAmount}}</td>
                <td data-title="'Сплатити до'">{{row.payment_date}}</td>
                <td data-title="'Надрукувати'">
                    <a href="{{invoiceUrl}}{{row.id}}/?nolayout=1">переглянути</a>
                </td>
            </tr>
        </table>
    </div>
</div>
