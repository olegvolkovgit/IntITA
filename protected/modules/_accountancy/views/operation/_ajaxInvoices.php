<?php
/**
 * @var $invoice Invoice
 */
if(!empty($invoices)){
    ?>
       Список рахунків-фактур по номеру договору <?php echo $invoices[0]->getAgreementNumber() ?>
        <?php

        foreach($invoices as $invoice)
        {?>
            <div>
                <input type="checkbox" name="invoices[]" value="<?php echo $invoice->id ?>"> Користувач:
                <?php echo StudentReg::getUserNamePayment($invoice->user_created); ?>
                Сервіс: <?php echo $invoice->getServiceDescription() ?>
                Дата: <?php echo date("d.m.y", strtotime($invoice->date_created))  ?>
            </div>
        <?php }?>

<?php } ?>