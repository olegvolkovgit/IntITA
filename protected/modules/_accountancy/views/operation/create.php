<?php
/* @var $this OperationController */
/* @var $model Operation */
/* @var $type OperationType*/
/* @var $form CActiveForm */
?>

<h1>Додати операцію</h1>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/operation.css"/>

<div class="operation2">
    <input type="radio" name="operation2a" id="operation2a_1" checked="checked">
    <input type="radio" name="operation2a" id="operation2a_2">
    <input type="radio" name="operation2a" id="operation2a_3">
    <input type="radio" name="operation2a" id="operation2a_4">

    <div>
        <label for="operation2a_1"><?php echo OperationType::getDescription(1);?></label>
        <?php echo $this->renderPartial('_operationForm1', array('agreementsList' => $agreementsList));?>
    </div>
    <div>
        <label for="operation2a_2"><?php echo OperationType::getDescription(2);?></label>
        <?php echo $this->renderPartial('_operationForm2', array('invoicesList'=>$invoicesList));?>
    </div>
</div>
<br>
<br>

