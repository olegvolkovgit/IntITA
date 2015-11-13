<?php
/**
 * @var $invoice UserAgreements
 */
?>
<h3>Рахунок:</h3>
<form action="<?php echo Yii::app()->createUrl('/_accountancy/operation/createByInvoice');?>"
      method="POST" name="newOperation" class="formatted-form">
<div id="operationForm2">
    <select name="agreement">
        <option value="">Виберіть рахунок</option>
            <?php
            $invoiceList = Invoice::getAllInvoices();
            foreach($invoiceList as $invoice){
                ?>
                <option value="<?php echo $invoice->id;?>"><?php echo $invoice->summa;?></option>
            <?php
            }
            ?>
    </select>
    <br/>
    <br/>
    <button type="submit">Додати</button>
</div>
</form>