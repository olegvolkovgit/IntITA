<?php
/* @var $this OperationController */
/* @var $model Operation */
/* @var $type OperationType*/
/* @var $form CActiveForm */
?>
<link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.css'); ?>" rel="stylesheet">
<link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap-theme.css'); ?>" rel="stylesheet">
<link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/operation.css"/>
<h1>Додати проплату</h1>
<br>
<!--<div class="mainOperation">-->
<!--<ul class="operationCreate">-->
<!--    <li role="presentation" class="operationPanel" ><button onclick="showOperation(0)">Пошук по договору</button></li>-->
<!--    <li role="presentation" class="operationPanel" ><button onclick="showOperation(1)">Пошук по номеру рахунка</button></li>-->
<!--    <li role="presentation" class="operationPanel" ><button onclick="showOperation(2)">Пошук по користувачу</button></li>-->
<!--</ul>-->
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#findOffer">Пошук по договору</a></li>
    <li><a data-toggle="tab" href="#findOperation">Пошук по номеру рахунка</a></li>
    <li><a data-toggle="tab" href="#findUser">Пошук по користувачу</a></li>
</ul>

    <div class="tab-content">
        <div  id="findOffer" class="findOffer tab-pane fade in active" >
            <?php echo $this->renderPartial('_operationForm1', array('agreementsList' => ''));?>
        </div>

        <div  id="findOperation" class="findOperation tab-pane fade" >
            <?php echo $this->renderPartial('_operationForm2', array('invoicesList'=>''));?>
        </div>

        <div  id="findUser" class="findOperation tab-pane fade" >
            <?php echo $this->renderPartial('_operationForm3', array('invoicesList'=>''));?>
        </div>
    </div>

<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_accountancy/agreement.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('css', '/bower_components/jquery/dist/jquery.min.js');?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('css', '/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>

