<?php
/**
 * @var $agreement UserAgreements
 */
?>
<div id="operationForm1">
    <form method="POST" name="newOperation" action="#"
        <?php echo Yii::app()->createUrl('/_teacher/_accountant/operation/getSearchAgreements');?>>
        <fieldset form="newOperation" title="Пошук договора">
            <br>
            <form class="form-inline">
                <div class="input-group  col-sm-4">
                    <div class="input-group-addon">№</div>
                    <input type="typeahead" class="form-control" name="agreementNumber" id="agreementNumber"
                           onkeyup="getAgreementsList('<?php echo Yii::app()->createUrl("/_teacher/_accountant/operation/getSearchAgreements"); ?>')"
                           placeholder="Введіть номер договору">
                </div>
            </form>
        </fieldset>
    </form>
    <div name="selectAgreement" id="resultAgreement">
        <?php $this->renderPartial('_ajaxAgreement', array('agreements' => '')); ?>
    </div>
    <form name="invoicesForm">
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
                    <div class="input-group col-sm-6">
                        <div class="input-group-addon" id="icon">uah</div>
                        <input type="number" class="form-control" name="summa" min="0" id="summa" value="" required
                               placeholder="Введіть суму операції"/>
                        <input type="number" name="user" value="<?php echo Yii::app()->user->getId(); ?>"
                               hidden="hidden">
                        <input type="number" name="type" value="1" hidden="hidden">
                        <input type="number" name="source" value="1" hidden="hidden">
                    </div>
                </div>
                <br/>
                <input type="submit" class="btn btn-primary"
                        onclick="newPayment('<?php echo Yii::app()->createUrl("/_teacher/_accountant/operation/createByInvoice"); ?>');" value="Додати">
            </div>
        </fieldset>
    </form>
</div>
<script>
    function newPayment(url){
        var invoices =checkInvoices();
        if(!invoices){
            showDialog("Виберіть хоча б один рахунок");
            return false;
        }else{
            summa = $jq("#summa").val();
            if (summa==0) {
                bootbox.alert('Введіть суму операції.');
            } else {
                var posting = $jq.post(url, {invoices:invoices,summa:summa,user: user,type:2,source:''});
                posting.done(function (response) {
                    if (response == 1) {
                        bootbox.alert("Оплата пройшла успішно", function () {
//                            location.href = window.location.pathname;
                        });
                    }
                    else {
                        bootbox.alert("Оплату здійснити не вдалося", function () {
//                            location.href = window.location.pathname;
                        });
                    }
                })
                    .fail(function () {
                        bootbox.alert("Помилка сервера. Оплату здійснити не вдалося", function () {
//                            location.href = window.location.pathname;
                        });
                    });
            }
        }
    }
</script>






