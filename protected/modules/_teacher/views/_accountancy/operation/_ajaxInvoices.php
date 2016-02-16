<?php
/**
 * @var $invoice Invoice
 */
if (!empty($invoices)) {
    ?>
    <div class="col-sm-8"><h3>Список рахунків-фактур по номеру
            договору <?php echo $invoices[0]->getAgreementNumber() ?></h3></div>
    <div class="col-sm-8">
        <table class="table table-hover">
            <thead>
            <tr class="info">
                <th class="glyphicon glyphicon-ok"></th>
                <th>Користувач</th>
                <th>Сервіс</th>
                <th>Дата</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($invoices as $invoice) {
                ?>
                <tr>
                    <td><input type="checkbox" name="invoices[]" value="<?php echo $invoice->id ?>"></td>
                    <td> <?php echo StudentReg::getUserNamePayment($invoice->user_created); ?></td>
                    <td> <?php echo $invoice->getServiceDescription() ?></td>
                    <td><?php echo date("d.m.y", strtotime($invoice->date_created)) ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php } ?>