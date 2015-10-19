<?php
    $module = Module::model()->findByPk($module);
     $price = ModuleHelper::getModuleSumma($module->module_ID, $idCourse);?>
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
                <span><?php echo ModuleHelper::getModulePricePayment($module->module_ID, 0, $idCourse); ?>
                </span>
            </div>
        </div>
    <?php } ?>
    <?php $this->endWidget();?>
</div>
<?php if ($price > 0){?>
<button class="ButtonFinances" style=" float:right; cursor:pointer" onclick="printAccount('<?php echo Yii::app()->user->getId();?>',
    '<?php echo ($module != null)?$module->module_ID:null;?>')"><?php echo Yii::t('profile', '0261'); ?></button>
<?php } else{
    setcookie("idModule", '', 1, '/');
    setcookie("idCourse", '', 1, '/');
}?>
<script>
    $(function() {
        $('input:radio[name="payment"]').filter('[value="1"]').attr('checked', true);
    });
    function printAccount(user, module){
        $.ajax({
            type: "POST",
            url: "/IntITA/payments/newAccount",
            data: {
                'user': user,
                'module': module,
                'course': '0'
            },
            cache: false,
            success: function(data){
                location.href = '/IntITA/payments/index?account=' + data;
            }
        });
    }
</script>