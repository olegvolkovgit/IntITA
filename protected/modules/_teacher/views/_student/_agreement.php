<?php
/* @var $agreement UserAgreements */
?>
<div class="titleAgreement">
    <h4>Рахунки до сплати за договором №<?php echo $agreement->number; ?> від
        <?= date("d.m.Y", strtotime($agreement->create_date));?></h4>
    <h4><?php echo $agreement->service->description; ?></h4>
    <h4>Форма
        навчання: <?= AbstractIntITAService::getServiceById($agreement->service->service_id)->getEducationForm()->title_ua ?></h4>
    <h4>Схема проплат: <?= $agreement->getPaymentSchema()->name; ?></h4>
</div>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="invoicesTable">
                    <thead>
                    <tr>
                        <th>Рахунок</th>
                        <th>Сума, грн.</th>
                        <th>Дата сплати</th>
                        <th>Надрукувати</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    initInvoicesTable('<?=$agreement->id?>');
</script>
