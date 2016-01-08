<?php
/**
 * @var $invoice UserAgreements
 */
?>


<!--<label for="operation2a_2" class="operationMargin">--><?php //echo OperationType::getDescription(2);?><!--</label>-->
<!---->
<!--<h3 class="operationMargin">Рахунок:</h3>-->
<br>
<div id="operationForm2">
    <form action="#" method="POST" name="newOperation" class="formatted-form" >
        <fieldset form="newOperation" title="Пошук рахунка">
<!--    <legend>Пошук рахунку по номеру:</legend>-->
<!--    <br>-->
<!--    Введіть номер рахунку:-->
<!--    <br>-->
            <form class="form-inline">
                <div class="input-group  col-sm-4">
                    <div class="input-group-addon">№</div>
                    <input type="text" class="form-control" name="invoiceNumber" id="invoiceNumber"
                           onkeyup="getInvoicesListByNumber('<?php echo Yii::app()->createUrl('/_accountancy/operation/getInvoicesByNumber');?>')"
                           placeholder="Введіть номер рахунку">
                </div>
            </form>
<!--    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--        <span class="searchCriteria">-->
<!--                <label for="numberCriteria">-->
<!--                    <input type="text" name="invoiceNumber" id="invoiceNumber" onkeyup="getInvoicesListByNumber()">-->
<!--                </label>-->
<!--        </span>-->
<!--    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
    </fieldset>
    </form>
</div>

<form action="<?php echo Yii::app()->createUrl('/_accountancy/operation/createByInvoice');?>" class="operationMargin"
              method="POST" onsubmit="return checkInvoices();">
            <fieldset form="newOperation" title="Результат пошуку рахунка">
            <div name="selectInvoicesByNumber" >
                <?php $this->renderPartial('_ajaxInvoices', array('invoices'=>'')); ?>
            </div>
            <input type="number" name="user" value="<?php echo Yii::app()->user->getId();?>" hidden="hidden">
            <input type="number" name="type" value="2" hidden="hidden">
            <input type="number" name="source" value="1" hidden="hidden">
                <br/>
                <div class="col-sm-8">
<!--            <label> Введіть суму операції:-->
                    <div class="form-inline">
                        <div class="input-group  col-sm-6">
                            <div class="input-group-addon" id="icon">uah</div>
                            <input type="number" name="summa" value="" class="form-control" required="true" placeholder="Введіть суму операції"/>
                        </div>
                    </div>

<!--                <input type="number" name="summa" value="" />-->
<!--            </label>-->
            <br/>
                    <button type="submit" class="btn btn-primary">Додати</button>
                </div>
            </fieldset>
    </form>

