<?php
    $module = Module::model()->findByPk($_COOKIE['idModule']);
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
    $payment = new PaymentPlan();
    if ($module->module_price == 0) echo Yii::t('courses', '0147').' '.CourseHelper::getMainCoursePrice($module->module_price, 25);
    else {
        ?>
        <div id="rowRadio">
            <div class="paymentsListOdd"><input type="radio" class="paymentPlan_value" name="payment" value="1">
                <span><?php echo ModuleHelper::getModulePricePayment(
                        StaticFilesHelper::createPath('image', 'course', 'wallet.png'),
                        StaticFilesHelper::createPath('image', 'course', 'checkWallet.png'),
                        'Ціна за модуль',
                        $module->module_price,
                        0,
                        (isset($_COOKIE['idCourse']) && $_COOKIE['idCourse'] != '0')?false:true
                        ) ?></span>
            </div>
        </div>
    <?php } ?>
    <?php $this->endWidget(); ?>
</div>
<?php if ($module->module_price > 0){?>
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
            url: "/accountancy/newAccount",
            data: {
                'user': user,
                'module': module,
                'course': '0'
            },
            cache: false,
            success: function(data){
                location.href = '/accountancy/index?account=' + data;
            }
        });
    }
</script>