<?php
$model = Course::model()->findByPk($course);
$module = null;
?>
<script src="<?php echo Config::getBaseUrl(); ?>/scripts/spoilerPayProfile.js"></script>

<link type="text/css" rel="stylesheet" href="<?php echo Config::getBaseUrl(); ?>/css/spoilerPay.css"/>

<div class="paymentsForm">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => '#',
        'id' => 'payments-form',
        'enableAjaxValidation' => false,
    )); ?>
    <?php
    $payment = new PaymentPlan();
    if ($model['course_price'] == 0) echo Yii::t('courses', '0147') . ' ' . CourseHelper::getMainCoursePrice($model['course_price'], 25);
    else {
        ?>
        <span class="spoilerLinks"
              onclick="paymentSpoiler('<?php echo Yii::t('course', '0414'); ?>', '<?php echo Yii::t('course', '0415'); ?>')"><span
                id="spoilerClick"><?php echo Yii::t('course', '0415'); ?></span><span id="spoilerTriangle"> &#9660;</span></span>
        <div id="rowRadio">
            <div class="paymentsListOdd"><input type="radio" class="paymentPlan_value" name="payment"
                                                value="1"><span><?php echo CourseHelper::getCoursePrice(StaticFilesHelper::createPath('image', 'course', 'wallet.png'), StaticFilesHelper::createPath('image', 'course', 'checkWallet.png'), Yii::t('course', '0197'), $model->course_price, 30) ?></span>
            </div>
            <div class="spoilerBody">
                <div class="paymentsListEven"><input type="radio" class="paymentPlan_value" name="payment"
                                                     value="2"><span><?php echo CourseHelper::getCoursePricePayments(StaticFilesHelper::createPath('image', 'course', 'coins.png'), StaticFilesHelper::createPath('image', 'course', 'checkCoins.png'), $model->course_price, 2, 10) ?></span>
                </div>
                <div class="paymentsListOdd"><input type="radio" class="paymentPlan_value" name="payment"
                                                    value="3"><span><?php echo CourseHelper::getCoursePricePayments(StaticFilesHelper::createPath('image', 'course', 'moreCoins.png'), StaticFilesHelper::createPath('image', 'course', 'checkMoreCoins.png'), $model->course_price, 4, 8) ?></span>
                </div>
                <div class="paymentsListEven"><input type="radio" class="paymentPlan_value" name="payment"
                                                     value="4"><span><?php echo CourseHelper::getCoursePriceMonths(StaticFilesHelper::createPath('image', 'course', 'calendar.png'), StaticFilesHelper::createPath('image', 'course', 'checkCalendar.png'), Yii::t('course', '0200'), round($model->course_price / 12,2), 12) ?></span>
                </div>
                <div class="paymentsListOdd"><input type="radio" class="paymentPlan_value" name="payment"
                                                    value="5"><span><?php echo CourseHelper::getCoursePriceCredit(StaticFilesHelper::createPath('image', 'course', 'percent.png'), StaticFilesHelper::createPath('image', 'course', 'checkPercent.png'), round(($model->course_price/24)*1.25,2), 2) ?></span>
                </div>
                <div class="paymentsListEven"><input type="radio" class="paymentPlan_value" name="payment"
                                                     value="6"><span><?php echo CourseHelper::getCoursePriceCredit(StaticFilesHelper::createPath('image', 'course', 'percent.png'), StaticFilesHelper::createPath('image', 'course', 'checkPercent.png'), round(($model->course_price / 36)*1.5625,2), 3) ?></span>
                </div>
                <div class="paymentsListOdd"><input type="radio" class="paymentPlan_value" name="payment"
                                                    value="7"><span><?php echo CourseHelper::getCoursePriceCredit(StaticFilesHelper::createPath('image', 'course', 'percent.png'), StaticFilesHelper::createPath('image', 'course', 'checkPercent.png'), round(($model->course_price / 48) * 1.9535,2), 4) ?></span>
                </div>
                <div class="paymentsListEven"><input type="radio" class="paymentPlan_value" name="payment"
                                                     value="8"><span><?php echo CourseHelper::getCoursePriceCredit(StaticFilesHelper::createPath('image', 'course', 'percent.png'), StaticFilesHelper::createPath('image', 'course', 'checkPercent.png'), round(($model->course_price / 60) * 2.3276,2), 5) ?></span>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php $this->endWidget(); ?>
</div>
<br>
        <button class="ButtonFinances" style=" float:right; cursor:pointer" onclick="printAccount('<?php echo Yii::app()->user->getId();?>',
            '<?php echo ($model != null)?$model->course_ID:null;?>')"><?php echo Yii::t('profile', '0261'); ?></button>

<script>
    $(function() {
        $('input:radio[name="payment"]').filter('[value="1"]').attr('checked', true);
    });
    function printAccount(user,course){
        var summaNum = $("input[name='payment']:checked").val();
        $.ajax({
            type: "POST",
            url: "/accountancy/newAccount",
            data: {
                'user': user,
                'module': '0',
                'course': course,
                'summaNum': summaNum
            },
            cache: false,
            success: function(data){
                location.href = '/accountancy/index?account=' + data;
            }
        });
    }
</script>