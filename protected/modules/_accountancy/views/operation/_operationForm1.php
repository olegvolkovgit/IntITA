<?php
/**
 * @var $agreement UserAgreements
 */
?>
<label for="operation2a_1" class="operationMargin"><?php echo OperationType::getDescription(1);?></label>

<h3 class="operationMargin">Договір:</h3>
    <div id="operationForm1">
        <!--Search form by agreement criteria-->
        <form method="POST" name="newOperation" class="formatted-form" action="#"
        <?php //echo Yii::app()->createUrl('/_accountancy/operation/getSearchAgreements');?>>
        <fieldset form="newOperation" title="Пошук договора">
            <legend>Пошук рахунку по договору:</legend>
            <br>
            Введіть номер договору:
            <br>

            <span class="searchCriteria">
                <label for="numberCriteria">
                    <input type="typeahead" name="agreementNumber" id="agreementNumber" onkeyup="getAgreementsList()">
                </label>
            </span>
        </fieldset>
            </form>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
        <div name="selectAgreement" id="resultAgreement" >
            <?php $this->renderPartial('_ajaxAgreement', array('agreements'=>'')); ?>
        </div>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
        <!--Operation form-->
        <form action="<?php echo Yii::app()->createUrl('/_accountancy/operation/createByInvoice'); ?>"
              method="POST" name="newOperation" class="formatted-form" onsubmit="return checkInvoices();">
            <input type="number" name="user" value="<?php echo Yii::app()->user->getId(); ?>" hidden="hidden">
            <input type="number" name="type" value="1" hidden="hidden">
            <input type="number" name="source" value="1" hidden="hidden">
            <fieldset>
        Результати пошуку:
        <br/>
                <div name="selectInvoices" id="selectInvoices">
                    <?php $this->renderPartial('_ajaxInvoices', array('invoices'=>'')); ?>
                </div>
        <br/>
        <label> Введіть суму операції:
            <br/>
            <input type="number" name="user" value="<?php echo Yii::app()->user->getId();?>" hidden="hidden">
            <input type="number" name="type" value="1" hidden="hidden">
            <input type="number" name="source" value="1" hidden="hidden">
            <input type="number" name="summa" value="" required="true"/>
        </label>
        <br/>
            <br/>
        <button type="submit">Додати</button>
                </fieldset>
        </form>
    </div>



