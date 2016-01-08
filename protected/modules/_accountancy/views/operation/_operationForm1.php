<?php
/**
 * @var $agreement UserAgreements
 */
?>


<!--<label for="operation2a_1" class="operationMargin">--><?php //echo OperationType::getDescription(1);?><!--</label>-->

<!--<h3 class="operationMargin">Договір:</h3>-->
    <div id="operationForm1">
        <!--Search form by agreement criteria-->
        <form method="POST" name="newOperation" class="formatted-form" action="#"
        <?php //echo Yii::app()->createUrl('/_accountancy/operation/getSearchAgreements');?>>
        <fieldset form="newOperation" title="Пошук договора">
<!--            <legend>Пошук рахунку по договору:</legend>-->
<!--            <h3>Введіть номер договору:</h3>-->
            <br>
            <form class="form-inline">
                    <div class="input-group  col-sm-4">
                        <div class="input-group-addon">№</div>
                        <input type="typeahead" class="form-control" name="agreementNumber" id="agreementNumber"
                               onkeyup="getAgreementsList('<?php echo Yii::app()->createUrl("/_accountancy/operation/getSearchAgreements");?>')"
                               placeholder="Введіть номер договору">
                    </div>
            </form>

<!--            <span class="searchCriteria">-->
<!--                <label for="numberCriteria">-->
<!--                    <input type="typeahead" name="agreementNumber" id="agreementNumber" onkeyup="getAgreementsList()">-->
<!--                </label>-->
<!--            </span>-->
        </fieldset>
            </form>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
        <div name="selectAgreement" id="resultAgreement" >
            <?php $this->renderPartial('_ajaxAgreement', array('agreements'=>'')); ?>
        </div>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
        <!--Operation form-->
        <form action="<?php echo Yii::app()->createUrl('/_accountancy/operation/createByInvoice'); ?>"
              method="POST" name="newOperation" class="formatted-form"
              onsubmit="return checkInvoices('<?php echo Yii::app()->createUrl('/_accountancy/operation/createByInvoice');?>')">
            <input type="number" name="user" value="<?php echo Yii::app()->user->getId(); ?>" hidden="hidden">
            <input type="number" name="type" value="1" hidden="hidden">
            <input type="number" name="source" value="1" hidden="hidden">
            <fieldset>
<!--        Результати пошуку:-->
        <br/>
                <div name="selectInvoices" id="selectInvoices">
                    <?php $this->renderPartial('_ajaxInvoices', array('invoices'=>'')); ?>
                </div>

        <div class="col-sm-8">

<!--        <label> Введіть суму операції:-->
<!--            <br/>-->
            <div class="form-inline">
                <div class="input-group  col-sm-6">
                    <div class="input-group-addon" id="icon">uah</div>
                    <input type="number" class="form-control" name="summa" value="" required="true" placeholder="Введіть суму операції"/>
                    <input type="number" name="user" value="<?php echo Yii::app()->user->getId();?>" hidden="hidden">
                    <input type="number" name="type" value="1" hidden="hidden">
                    <input type="number" name="source" value="1" hidden="hidden">
                </div>
            </div>

<!--        </label>-->
            <br/>
        <button type="submit" class="btn btn-primary">Додати</button>
        </div>
                </fieldset>
        </form>
    </div>






