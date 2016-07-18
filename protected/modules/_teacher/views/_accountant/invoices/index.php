<?php
/* @var $invoices array
 * @var $invoice Invoice
 */
?>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" cellspacing="0" id="invoices">
                    <thead>
                    <tr>
                        <th>id рахунку</th>
                        <th>Договір</th>
                        <th>Дата заведення</th>
                        <th>До сплати</th>
                        <th>Користувач</th>
                        <th>Оплатити до</th>
                        <th>Сплачено</th>
                        <th>Дійсний до</th>
                        <th>Відмінив</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($invoices as $invoice) {
                        ?>
                        <tr class="odd gradeX">
                            <td><?= $invoice->id; ?></td>
                            <td>
                                <?php if(isset($invoice->agreement)) { ?>
                                <a href="#" onclick="load(
                                    '<?= Yii::app()->createUrl('/_teacher/_accountant/agreements/agreement', array('id' => $invoice->agreement_id)); ?>',
                                    'Договір'); return false;"><?= $invoice->agreement->number; ?></a>
                                <?php } else { echo 'Договір не знайдено'; } ?>
                            </td>
                            <td><?= ($invoice->date_created)? date("d.m.y", strtotime($invoice->date_created)):"" ?></td>
                            <td><?= $invoice->summa; ?></td>
                            <td><?= $invoice->userCreated->userNameWithEmail();?></td>
                            <td><?= ($invoice->payment_date)? date("d.m.y", strtotime($invoice->payment_date)):""; ?></td>
                            <td><?= ($invoice->pay_date)? date("d.m.y", strtotime($invoice->pay_date)):""; ?></td>
                            <td><?= ($invoice->expiration_date)? date("d.m.y", strtotime($invoice->expiration_date)):"" ?></td>
                            <td><?= ($invoice->user_cancelled)?$invoice->userCancelled->userNameWithEmail():"";?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $jq(document).ready(function () {
        $jq('#invoices').DataTable({
                "autoWidth": false,
                language: {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                }
            }
        );
    });
</script>
