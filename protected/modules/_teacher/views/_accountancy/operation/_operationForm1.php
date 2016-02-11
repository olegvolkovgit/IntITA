<?php
/**
 * @var $agreement UserAgreements
 */
?>
<div id="operationForm1">
    <form method="POST" name="newOperation" class="formatted-form" action="#"
        <?php echo Yii::app()->createUrl('/_teacher/_accountancy/operation/getSearchAgreements');?>>
        <fieldset form="newOperation" title="Пошук договора">
            <br>
            <form class="form-inline">
                <div class="input-group  col-sm-4">
                    <div class="input-group-addon">№</div>
                    <input type="typeahead" class="form-control" name="agreementNumber" id="agreementNumber"
                           onkeyup="getAgreementsList('<?php echo Yii::app()->createUrl("/_teacher/_accountancy/operation/getSearchAgreements"); ?>')"
                           placeholder="Введіть номер договору">
                </div>
            </form>
        </fieldset>
    </form>
    <div name="selectAgreement" id="resultAgreement">
        <?php $this->renderPartial('_ajaxAgreement', array('agreements' => '')); ?>
    </div>
    <form action="<?php echo Yii::app()->createUrl('/_teacher/_accountancy/operation/createByInvoice'); ?>"
          method="POST" name="newOperation" class="formatted-form"
          onsubmit="return checkInvoices('<?php echo Yii::app()->createUrl('/_teacher/_accountancy/operation/createByInvoice'); ?>')">
        <input type="number" name="user" value="<?php echo Yii::app()->user->getId(); ?>" hidden="hidden">
        <input type="number" name="type" value="1" hidden="hidden">
        <input type="number" name="source" value="1" hidden="hidden">
        <fieldset>
            <br/>
            <div name="selectInvoices" id="selectInvoices">
                <?php $this->renderPartial('_ajaxInvoices', array('invoices' => '')); ?>
            </div>
            <div class="col-sm-8">
                <div class="form-inline">
                    <div class="input-group  col-sm-6">
                        <div class="input-group-addon" id="icon">uah</div>
                        <input type="number" class="form-control" name="summa" value="" required
                               placeholder="Введіть суму операції"/>
                        <input type="number" name="user" value="<?php echo Yii::app()->user->getId(); ?>"
                               hidden="hidden">
                        <input type="number" name="type" value="1" hidden="hidden">
                        <input type="number" name="source" value="1" hidden="hidden">
                    </div>
                </div>
                <br/>
                <button type="submit" class="btn btn-primary">Додати</button>
            </div>
        </fieldset>
    </form>
</div>






