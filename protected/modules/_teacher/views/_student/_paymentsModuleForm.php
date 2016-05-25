<?php
/**
 * @var $model Module
 * @var $course int
 * @var $scenario string
 */
$price = Module::getModuleSumma($model->module_ID, $course);
?>
<div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-body" style="margin-left: 30px; margin-top: 20px">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'action' => '#',
                'id' => 'payments-form',
                'enableAjaxValidation' => false,
            ));
            if ($price == 0) echo Yii::t('courses', '0147') . ' ' .
                Module::getModulePricePayment($model->module_ID, 0, $course);
            else {
                ?>
                <div id="rowRadio">
                    <div class="paymentsListOdd">
                        <input type="radio" class="paymentPlan_value" name="payment" value="1">
                <span><?php echo Module::getModulePricePayment($model->module_ID, 0, $course); ?>
                </span>
                    </div>
                </div>
            <?php } ?>
            <input name="module" type="hidden" value="<?php echo $model->module_ID; ?>">
            <input name="user" type="hidden" value="<?php echo Yii::app()->user->getId(); ?>">
            <input name="educationForm" type="hidden" value="<?= $scenario ?>">
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>

<?php if ($price > 0) { ?>
    <br>
    <button class="btn btn-primary" type="button"
            onclick="createAccount('<?php echo Yii::app()->createUrl('/_teacher/_student/student/newModuleAgreement'); ?>',
                '<?=$course?>', '<?php echo $model->module_ID; ?>', 'module')"><?php echo Yii::t('profile', '0261'); ?></button>
<?php } ?>

<script>
    $jq(function () {
        $jq('input:radio[name="payment"]').filter('[value="1"]').attr('checked', true);
    });
</script>