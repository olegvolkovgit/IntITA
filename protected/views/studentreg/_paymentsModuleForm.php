<?php
    $module = Module::model()->findByPk($module);
    $price = ModuleHelper::getModuleSumma($module->module_ID, $course);
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'spoilerPayProfile.js') ?>"></script>

<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'spoilerPay.css');?>"/>

<div class="paymentsForm">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => '#',
        'id' => 'payments-form',
        'enableAjaxValidation' => false,
    )); ?>
    <?php

    if ($price == 0) echo Yii::t('courses', '0147').' '.
        ModuleHelper::getModulePricePayment($module->module_ID, 0, $course);
    else {

        ?>
        <div id="rowRadio">
            <div class="paymentsListOdd">
                <input type="radio" class="paymentPlan_value" name="payment" value="1">
                <span><?php echo ModuleHelper::getModulePricePayment($module->module_ID, 0, $course); ?>
                </span>
            </div>
        </div>
    <?php } ?>
    <?php $this->endWidget();?>
</div>
<div id="kalebas"></div>
    <?php echo CHtml::button(Yii::t('profile', '0261'), array('class' => "ButtonFinances",
        'submit' => array('payments/index'),
        'params' => array(
            'type' => 'Module',
            'user' => Yii::app()->user->getId(),
            'course' => '0',
            'module' => $module->module_ID)
        )
    );?>

<script>
    $(function() {
        $('input:radio[name="payment"]').filter('[value="1"]').attr('checked', true);
    });    
</script>