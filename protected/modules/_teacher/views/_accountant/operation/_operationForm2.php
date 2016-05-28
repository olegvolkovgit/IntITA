<?php
/**
 * @var $invoice UserAgreements
 */
?>
<br>
<div id="operationForm2">
    <form action="#" method="POST" name="newOperation">
        <fieldset form="newOperation" title="Пошук рахунка">
            <form class="form-inline">
                <div class="input-group  col-sm-4">
                    <div class="input-group-addon">№</div>
                    <input type="text" class="form-control" name="invoiceNumber" id="invoiceNumber"
                           onkeyup="getInvoicesListByNumber('<?php echo Yii::app()->createUrl('/_accountant/operation/getInvoicesByNumber'); ?>')"
                           placeholder="Введіть номер рахунку">
                </div>
            </form>
        </fieldset>
    </form>
    <form action="<?php echo Yii::app()->createUrl('/_teacher/_accountant/operation/createByInvoice'); ?>"
          method="POST" onsubmit="return checkInvoices();">
        <fieldset title="Результат пошуку рахунка">
            <div name="selectInvoicesByNumber">
                <?php $this->renderPartial('_ajaxInvoices', array('invoices' => '')); ?>
            </div>
            <input type="number" name="user" value="<?php echo Yii::app()->user->getId(); ?>" hidden="hidden">
            <input type="number" name="type" value="2" hidden="hidden">
            <input type="number" name="source" value="1" hidden="hidden">
            <br/>
            <div class="col-sm-8">
                <div class="form-inline">
                    <div class="input-group  col-sm-6">
                        <div class="input-group-addon" id="icon">uah</div>
                        <input type="number" name="summa" value="" class="form-control" required
                               placeholder="Введіть суму операції"/>
                    </div>
                </div>
                <br/>
                <button type="submit" class="btn btn-primary">Додати</button>
            </div>
        </fieldset>
    </form>
</div>

