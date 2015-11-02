<?php
$model = Course::model()->findByPk($course);
$module = null;
$price = Course::getCoursePrice($course);
?>
<script>
    $(document).ready(function(){
        $(".tabs").lightTabs(<?php echo $schema;?>,'profile');
    });
</script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'spoilerPayProfile.js') ?>"></script>

<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'spoilerPay.css');?>"/>

<p class="payments"><?php echo Yii::t('payment', '0637');?></p>

<div class="paymentsForm">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => '#',
        'id' => 'payments-form',
        'enableAjaxValidation' => false,
    )); ?>
    <?php
    if ($price == 0) echo Yii::t('courses', '0147') . ' ' . CourseHelper::getMainCoursePrice($price, 25);
    else {
        ?>
        <span class="spoilerLinks"
              onclick="paymentSpoiler('<?php echo Yii::t('course', '0414'); ?>', '<?php echo Yii::t('course', '0415'); ?>')"><span
                id="spoilerClick"><?php echo Yii::t('course', '0415'); ?></span>
            <span id="spoilerTriangle"> &#9660;</span></span>
        <div id="rowRadio">
            <div class="paymentsListOdd"><input id='firstRadio' type="radio" class="paymentPlan_value"
                                                name="payment"
                                                value="1"><span><?php echo CourseHelper::getCoursePrice(
                        StaticFilesHelper::createPath('image', 'course', 'wallet.png'),
                        StaticFilesHelper::createPath('image', 'course', 'checkWallet.png'), Yii::t('course', '0197'),
                        CourseHelper::getSummaWholeCourse($model->course_ID), 30) ?></span>
            </div>
            <div class="spoilerBody">
                <div class="paymentsListEven"><input type="radio" class="paymentPlan_value" name="payment"
                                                     value="2"><span><?php echo CourseHelper::getCoursePricePayments(
                            StaticFilesHelper::createPath('image', 'course', 'coins.png'),
                            StaticFilesHelper::createPath('image', 'course', 'checkCoins.png'),
                            CourseHelper::getSummaWholeCourse($model->course_ID), 2, 10); ?></span>
                </div>
                <div class="paymentsListOdd"><input type="radio" class="paymentPlan_value" name="payment"
                                                    value="3"><span><?php echo CourseHelper::getCoursePricePayments(
                            StaticFilesHelper::createPath('image', 'course', 'moreCoins.png'),
                            StaticFilesHelper::createPath('image', 'course', 'checkMoreCoins.png'),
                            CourseHelper::getSummaWholeCourse($model->course_ID), 4, 8) ?></span>
                </div>
                <div class="paymentsListEven"><input type="radio" class="paymentPlan_value" name="payment"
                                                     value="4"><span><?php echo CourseHelper::getCoursePriceMonths(
                            StaticFilesHelper::createPath('image', 'course', 'calendar.png'),
                            StaticFilesHelper::createPath('image', 'course', 'checkCalendar.png'),
                            Yii::t('course', '0200'),
                            CourseHelper::getSummaBySchemaNum($model->course_ID, 4), 12, $model->course_ID) ?></span>
                </div>
                <div class="paymentsListOdd"><input type="radio" class="paymentPlan_value" name="payment"
                                                    value="5"><span><?php echo CourseHelper::getCoursePriceCredit(
                            StaticFilesHelper::createPath('image', 'course', 'percent.png'),
                            StaticFilesHelper::createPath('image', 'course', 'checkPercent.png'),
                            CourseHelper::getSummaBySchemaNum($model->course_ID, 5), 2, $model->course_ID) ?></span>
                </div>
                <div class="paymentsListEven"><input type="radio" class="paymentPlan_value" name="payment"
                                                     value="6"><span><?php echo CourseHelper::getCoursePriceCredit(
                            StaticFilesHelper::createPath('image', 'course', 'percent.png'),
                            StaticFilesHelper::createPath('image', 'course', 'checkPercent.png'),
                            CourseHelper::getSummaBySchemaNum($model->course_ID, 6), 3, $model->course_ID) ?></span>
                </div>
                <div class="paymentsListOdd"><input type="radio" class="paymentPlan_value" name="payment"
                                                    value="7"><span><?php echo CourseHelper::getCoursePriceCredit(
                            StaticFilesHelper::createPath('image', 'course', 'percent.png'),
                            StaticFilesHelper::createPath('image', 'course', 'checkPercent.png'),
                            CourseHelper::getSummaBySchemaNum($model->course_ID, 7), 4, $model->course_ID) ?></span>
                </div>
                <div class="paymentsListEven"><input type="radio" class="paymentPlan_value" name="payment"
                                                     value="8"><span><?php echo CourseHelper::getCoursePriceCredit(
                            StaticFilesHelper::createPath('image', 'course', 'percent.png'),
                            StaticFilesHelper::createPath('image', 'course', 'checkPercent.png'),
                            CourseHelper::getSummaBySchemaNum($model->course_ID, 8), 5, $model->course_ID) ?></span>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php $this->endWidget(); ?>
</div>
<br>
<?php if ($model->course_price > 0){?>
        <button class="ButtonFinances" style=" float:right; cursor:pointer" onclick="printAccount('<?php echo Yii::app()->user->getId();?>',
            '<?php echo ($model != null)?$model->course_ID:null;?>')"><?php echo Yii::t('profile', '0261'); ?></button>
<?php }?>
<script>
    $(function() {
        schema = $.cookie('courseSchema');
        if (schema > 0){
            $('input:radio[name="payment"]').filter('[value="'+schema+'"]').attr('checked', true);
        } else {
            $('input:radio[name="payment"]').filter('[value="1"]').attr('checked', true);
        }
    });
    function printAccount(user,course){
        var summaNum = $("input[name='payment']:checked").val();
        $.ajax({
            type: "POST",
            url: "/IntIta/payments/newAccount",
            data: {
                'user': user,
                'module': '0',
                'course': course,
                'summaNum': summaNum
            },
            cache: false,
            success: function(data){
                location.href = '/IntIta/payments/index?account=' + data;
            }
        });
    }
</script>