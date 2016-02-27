<?php
/* @var $invoices array
 * @var $invoice Invoice
 */
?>
<br>
<button class="btn btn-primary"
        onclick="load('<?php echo Yii::app()->createUrl("/_teacher/_accountancy/invoices/index");?>',
            'Список всіх рахунків')">Список всіх рахунків
</button>
<br>
<br>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" cellspacing="0" id="invoices">
                    <thead>
                    <tr>
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
                            <td><a href="#" onclick="load(
                                    '<?= Yii::app()->createUrl('/_teacher/_accountancy/agreements/agreement', array('id' => $invoice->agreement_id)); ?>',
                                    'Договір'); return false;">Договір <?=$invoice->agreement->number; ?></a></td>
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
                language: {
                    "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                },
                dom: "<'row'<'col-sm-6'f><'col-sm-6'l>>"
            }
        );
    });
</script>

