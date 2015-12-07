<?php
$model = Course::model()->findByPk($course);
$module = null;
$price = Course::getPrice($course);
?>
<script>
    $(document).ready(function () {
        $(".tabs").lightTabs(<?php echo $schema;?>, 'profile');
    });
</script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'spoilerPayProfile.js') ?>"></script>

<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'spoilerPay.css'); ?>"/>

<p class="payments"><?php echo Yii::t('payment', '0637'); ?></p>

<div class="paymentsForm">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl('payments/index'),
        'id' => 'payments-form',
        'method' => 'post',
        'enableAjaxValidation' => false,
    )); ?>
    <?php
    if ($price == 0) echo Yii::t('courses', '0147') . ' ' . Course::getMainCoursePrice($price, 25);
    else {
        ?>
        <span class="spoilerLinks"
              onclick="paymentSpoiler('<?php echo Yii::t('course', '0414'); ?>', '<?php echo Yii::t('course', '0415'); ?>')"><span
                id="spoilerClick"><?php echo Yii::t('course', '0415'); ?></span>
            <span id="spoilerTriangle"> &#9660;</span></span>
        <div id="rowRadio">
            <div class="paymentsListOdd">
                <input id='firstRadio' type="radio" class="paymentPlan_value" name="payment" value="1">
                <?php $this->renderPartial('/course/_advancePaymentSchema', array(
                    'model' => $model,
                    'price' => $price,
                    'discount' => 30
                )); ?>
            </div>

            <div class="spoilerBody">
                <div class="paymentsListEven">
                    <input type="radio" class="paymentPlan_value" name="payment" value="2">
                    <?php $this->renderPartial('/course/_basePaymentSchema', array(
                        'image1' => StaticFilesHelper::createPath('image', 'course', 'coins.png'),
                        'image2' => StaticFilesHelper::createPath('image', 'course', 'checkCoins.png'),
                        'model' => $model,
                        'price' => $price,
                        'number' => 2,
                        'discount' => 10
                    )); ?>
                </div>

                <div class="paymentsListOdd">
                    <input type="radio" class="paymentPlan_value" name="payment" value="3">
                    <?php $this->renderPartial('/course/_basePaymentSchema', array(
                        'image1' => StaticFilesHelper::createPath('image', 'course', 'moreCoins.png'),
                        'image2' => StaticFilesHelper::createPath('image', 'course', 'checkMoreCoins.png'),
                        'model' => $model,
                        'price' => $price,
                        'number' => 4,
                        'discount' => 8
                    )); ?>
                </div>

                <div class="paymentsListEven">
                    <input type="radio" class="paymentPlan_value" name="payment" value="4">
                    <?php $this->renderPartial('/course/_monthlyPaymentSchema', array('model' => $model, 'price' => $price)); ?>
                </div>

                <div class="paymentsListOdd">
                    <input type="radio" class="paymentPlan_value" name="payment" value="5">
                    <?php $this->renderPartial('/course/_creditPaymentSchema', array('model' => $model, 'price' => $price,
                        'year' => 2)); ?>
                </div>

                <div class="paymentsListEven">
                    <input type="radio" class="paymentPlan_value" name="payment" value="6">
                    <?php $this->renderPartial('/course/_creditPaymentSchema', array('model' => $model, 'price' => $price,
                        'year' => 3)); ?>
                </div>

                <div class="paymentsListOdd">
                    <input type="radio" class="paymentPlan_value" name="payment" value="7">
                    <?php $this->renderPartial('/course/_creditPaymentSchema', array('model' => $model, 'price' => $price,
                        'year' => 4)); ?>
                </div>

                <div class="paymentsListEven">
                    <input type="radio" class="paymentPlan_value" name="payment" value="8">
                    <?php $this->renderPartial('/course/_creditPaymentSchema', array('model' => $model, 'price' => $price,
                        'year' => 5)); ?>
                </div>
            </div>
            <input name="module" type="hidden" value="0">
            <input name="course" type="hidden" value="<?php echo $model->course_ID; ?>">
            <input name="user" type="hidden" value="<?php echo Yii::app()->user->getId(); ?>">
            <input name="type" type="hidden" value="Course">
        </div>
    <?php } ?>
    <?php if ($model->course_price > 0) { ?>
        <button class="ButtonFinances" style=" float:right; cursor:pointer"
                onclick="printAccount('<?php echo Yii::app()->user->getId(); ?>',
                    '<?php echo ($model != null) ? $model->course_ID : null; ?>')"><?php echo Yii::t('profile', '0261'); ?></button>
    <?php }
    $this->endWidget(); ?>
</div>
<br>

<div id="kalebas"></div>

<script>
    $(function () {
        schema = $.cookie('courseSchema');
        if (schema > 0) {
            $('input:radio[name="payment"]').filter('[value="' + schema + '"]').attr('checked', true);
        } else {
            $('input:radio[name="payment"]').filter('[value="1"]').attr('checked', true);
        }
    });
    function printAccount(){
        return $("input[name='payment']:checked").val();
    }
</script>