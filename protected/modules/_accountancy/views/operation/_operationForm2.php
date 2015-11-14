<?php
/**
 * @var $invoice UserAgreements
 */
?>
<h3>Рахунок:</h3>
<form action="<?php echo Yii::app()->createUrl('/_accountancy/operation/createByInvoice');?>"
      method="POST" name="newOperation" class="formatted-form">
<div id="operationForm2">
    <input type="number" name="user" value="<?php echo Yii::app()->user->getId();?>" hidden="hidden">
    <input type="number" name="type" value="1" hidden="hidden">
    <label>
    Рахунок:
    <br/>
    <select name="invoice">
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
    </label>
    <br/>
    <label> Введіть суму операції:
        <br/>
        <input type="number" name="summa" value="" />
    </label>
    <br/>
    <button type="submit">Додати</button>
</div>
</form>