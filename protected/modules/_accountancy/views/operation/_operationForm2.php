<?php
/**
 * @var $invoice UserAgreements
 */
?>
<label for="operation2a_2" class="operationMargin"><?php echo OperationType::getDescription(2);?></label>

<h3 class="operationMargin">Рахунок:</h3>

<div id="operationForm2">
    <form action="#" method="POST" name="newOperation" class="formatted-form" >
        <fieldset form="newOperation" title="Пошук рахунка">
    <legend>Пошук рахунку по номеру:</legend>
    <br>
    Введіть номер рахунку:
    <br>
<!--    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
        <span class="searchCriteria">
                <label for="numberCriteria">
                    <input type="text" name="invoiceNumber" id="invoiceNumber" onkeyup="getInvoicesListByNumber()">
                </label>
        </span>
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
            <label> Введіть суму операції:
                <br/>
                <input type="number" name="summa" value="" />
            </label>
            <br/>
            <button type="submit">Додати</button>
            </fieldset>
    </form>
