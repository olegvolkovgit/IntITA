<?php
/* @var $this OperationController */
/* @var $model Operation */
/* @var $type OperationType*/
/* @var $form CActiveForm */
?>
<h1>Додати операцію</h1>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/operation.css"/>
<!--<div class="operation2">-->
<!--    <input type="radio" name="operation2a" id="operation2a_1" checked="checked">-->
<!--    <input type="radio" name="operation2a" id="operation2a_2">-->
<!--    <input type="radio" name="operation2a" id="operation2a_3">-->
<!--    <input type="radio" name="operation2a" id="operation2a_4">-->
<!---->
<div class="mainOperation">
<ul class="operationCreate">
    <li role="presentation" class="operationPanel" ><button onclick="showOperation(1)">Пошук договора</button></li>
    <li role="presentation" class="operationPanel" ><button onclick="showOperation(2)">Операція</button></li>
</ul>
    <div class="findOffer" id="findOffer" >
        <?php echo $this->renderPartial('_operationForm1', array('agreementsList' => $agreementsList));?>
    </div>
    <div class="findOperation" id="findOperation">
        <?php echo $this->renderPartial('_operationForm2', array('invoicesList'=>$invoicesList));?>
    </div>
<!--</div>-->
<br>
<br>
</div>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_accountancy/agreement.js'); ?>"></script>

