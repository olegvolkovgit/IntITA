<?php
/* @var $this DefaultController */

?>
<h1>Розділи</h1>
<ul>
    <li><?php echo CHtml::link('Список договорів',array('/_accountancy/userAgreements/index')); ?>
    <li><?php echo CHtml::link('Список рахунків',array('/_accountancy/invoices/index')); ?>
    <li><?php echo CHtml::link('Проплати',array('/_accountancy/operation/index')); ?>
</ul>
<h2>Додаткові параметри</h2>
<ul>
    <li><?php echo CHtml::link('Типи проплат',array('/_accountancy/operationType/index')); ?>
    <li><?php echo CHtml::link('Зовнішні джерела коштів',array('/_accountancy/externalSources/index')); ?>
    <li><?php echo CHtml::link('Причини відміни проплат',array('/_accountancy/cancelReasonType/index')); ?>
</ul>
