<?php
/* @var $this OperationController */
?>

<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#findOffer">Пошук по договору</a></li>
    <li><a data-toggle="tab" href="#findOperation">Пошук по номеру рахунка</a></li>
    <li><a data-toggle="tab" href="#findUser">Пошук по користувачу</a></li>
</ul>


<div class="tab-content">
    <div id="findOffer" class="findOffer tab-pane fade in active">
        <?php echo $this->renderPartial('_operationForm1', array('agreementsList' => ''), false, true); ?>
    </div>

    <div id="findOperation" class="findOperation tab-pane fade">
        <?php echo $this->renderPartial('_operationForm2', array('invoicesList' => ''), false, true); ?>
    </div>

    <div id="findUser" class="findOperation tab-pane fade">
        <?php echo $this->renderPartial('_operationForm3', array('invoicesList' => ''), false, true); ?>
    </div>
</div>



