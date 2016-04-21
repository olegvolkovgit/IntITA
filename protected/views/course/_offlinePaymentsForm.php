<?php
/* @var $model Course */
$price = $model->getBasePrice();
if ($price == 0) {
    echo Yii::t('courses', '0147') . ' '; ?>
    <span class="colorGreen"><?= Yii::t('module', '0421'); ?></span>
    <?php
} else {
    ?>
    <span class="spoilerLinks"
          onclick="paymentSpoiler('<?php echo Yii::t('course', '0414'); ?>', '<?php echo Yii::t('course', '0415'); ?>', 'Offline')">
        <span id="spoilerClickOffline">Ціна за весь курс наперед (розгорнути схеми офлайн)</span>
        <span id="spoilerTriangleOffline"> &#9660;</span></span>
<?php }
if ($price != 0) {
    ?>
    <table class="mainPay">
        <tr>
            <td>
                <table>
                    <tr>
                        <td>
                            <div class="numbers" id="numbersFirstOffline">
                                <span
                                    class="coursePriceStatus1"><?php echo $price . " " . Yii::t('courses', '0322') ?></span>
                                &nbsp<span class="coursePriceStatus2">
                                <?php echo PaymentHelper::discountedPrice($price, 30) . " " . Yii::t('courses', '0322'); ?>
                            </span>
                            <span id="discount">
                                <img style="text-align:right" src="
                                <?php echo StaticFilesHelper::createPath('image', 'course', 'pig.png') ?>"/>
                                (<?php echo Yii::t('courses', '0144') . ' - 30%)'; ?>
                                </span>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
<?php } ?>
<div class="paymentsForm">
    <?php
    if ($model->status != 0) {
        $form = $this->beginWidget('CActiveForm', array(
            'action' => '#',
            'id' => 'payments-form',
            'enableAjaxValidation' => false,
        )); ?>
        <input value="1" type="hidden" name="schema"/>
        <div id="rowRadio">
            <div class="spoilerBodyOffline">
                <div class="paymentsListOdd">
                    <input id='firstRadioOffline' type="radio" class="paymentPlan_value" name="payment" value="1">
                    <?php $this->renderPartial('_advancePaymentSchema', array(
                        'model' => $model,
                        'price' => $price,
                        'discount' => 30
                    )); ?>
                </div>
            </div>
        </div>
        <?php if ($model->status != 0) {
            $this->endWidget();
        } ?>
    <?php } ?>
</div>
