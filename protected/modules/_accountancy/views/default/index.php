<?php
/* @var $this DefaultController */

?>
<!--<h1>Розділи</h1>-->
<!--<ul>-->
<!--    <li>--><?php //echo CHtml::link('Список договорів',array('/_accountancy/userAgreements/index')); ?>
<!--    <li>--><?php //echo CHtml::link('Список рахунків',array('/_accountancy/invoices/index')); ?>
<!--    <li>--><?php //echo CHtml::link('Проплати',array('/_accountancy/operation/index')); ?>
<!--</ul>-->
<!--<h2>Додаткові параметри</h2>-->
<!--<ul>-->
<!--    <li>--><?php //echo CHtml::link('Типи проплат',array('/_accountancy/operationType/index')); ?>
<!--    <li>--><?php //echo CHtml::link('Зовнішні джерела коштів',array('/_accountancy/externalSources/index')); ?>
<!--    <li>--><?php //echo CHtml::link('Причини відміни проплат',array('/_accountancy/cancelReasonType/index')); ?>
<!--</ul>-->
<div class="row">
    <br>
    <div class="list-group col-md-3 col-sm-4 col-xs-8">
        <div class="panel panel-primary">
            <div class="panel-heading">Розділи</div>
            <div class="panel-body">
                <button class="list-group-item "><?php echo CHtml::link('Список договорів',array('/_accountancy/userAgreements/index')); ?></button>
                <button class="list-group-item "><?php echo CHtml::link('Список рахунків',array('/_accountancy/invoices/index')); ?></button>
                <button class="list-group-item"><?php echo CHtml::link('Проплати',array('/_accountancy/operation/index')); ?></button>
                    <div class="panel panel-info">
                        <div class="panel-heading">Додаткові параметри</div>
                        <button class="list-group-item"><?php echo CHtml::link('Типи проплат',array('/_accountancy/operationType/index')); ?></button>
                        <button class="list-group-item"><?php echo CHtml::link('Зовнішні джерела коштів',array('/_accountancy/externalSources/index')); ?></button>
                        <button class="list-group-item"><?php echo CHtml::link('Причини відміни проплат',array('/_accountancy/cancelReasonType/index')); ?></button>
                    </div>
            </div>
        </div>
    </div>
</div>
