<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 26.09.2015
 * Time: 11:02
 */
$price = Course::getPrice($model->course_ID);
?>
<div class="paymentsForm">
    <?php
    if($model->status != 0){
    $form = $this->beginWidget('CActiveForm', array(
        'action' => '#',
        'id' => 'payments-form',
        'enableAjaxValidation' => false,
    )); ?>
<?php
if ($price == 0)
echo Yii::t('courses', '0147') . ' ' . Course::getMainCoursePrice($price, 30);
else {
?>
<input value="1" type="hidden" name="schema"/>
    <span class="spoilerLinks"
          onclick="paymentSpoiler('<?php echo Yii::t('course', '0414'); ?>', '<?php echo Yii::t('course', '0415'); ?>')"><span
            id="spoilerClick"><?php echo Yii::t('course', '0414'); ?></span><span
            id="spoilerTriangle"> &#9660;</span></span>

    <div id="rowRadio">
        <div class="paymentsListOdd"><input id='firstRadio' type="radio" class="paymentPlan_value"
                                            name="payment"
                                            value="1"><span><?php echo Course::getCoursePrice(
                    StaticFilesHelper::createPath('image', 'course', 'wallet.png'),
                    StaticFilesHelper::createPath('image', 'course', 'checkWallet.png'), Yii::t('course', '0197'),
                    Course::getSummaWholeCourse($model->course_ID), 30) ?></span>
        </div>
        <div class="spoilerBody">
            <div class="paymentsListEven"><input type="radio" class="paymentPlan_value" name="payment"
                                                 value="2"><span><?php echo Course::getCoursePricePayments(
                        StaticFilesHelper::createPath('image', 'course', 'coins.png'),
                        StaticFilesHelper::createPath('image', 'course', 'checkCoins.png'),
                        Course::getSummaWholeCourse($model->course_ID), 2, 10); ?></span>
            </div>
            <div class="paymentsListOdd"><input type="radio" class="paymentPlan_value" name="payment"
                                                value="3"><span><?php echo Course::getCoursePricePayments(
                        StaticFilesHelper::createPath('image', 'course', 'moreCoins.png'),
                        StaticFilesHelper::createPath('image', 'course', 'checkMoreCoins.png'),
                        Course::getSummaWholeCourse($model->course_ID), 4, 8) ?></span>
            </div>
            <div class="paymentsListEven"><input type="radio" class="paymentPlan_value" name="payment"
                                                 value="4"><span><?php echo Course::getCoursePriceMonths(
                        StaticFilesHelper::createPath('image', 'course', 'calendar.png'),
                        StaticFilesHelper::createPath('image', 'course', 'checkCalendar.png'),
                        Yii::t('course', '0200'),
                        Course::getSummaBySchemaNum($model->course_ID, 4), 12, $model->course_ID) ?></span>
            </div>
            <div class="paymentsListOdd"><input type="radio" class="paymentPlan_value" name="payment"
                                                value="5"><span><?php echo Course::getCoursePriceCredit(
                        StaticFilesHelper::createPath('image', 'course', 'percent.png'),
                        StaticFilesHelper::createPath('image', 'course', 'checkPercent.png'),
                        Course::getCreditCoursePrice($model->course_ID, 2), 2, $model->course_ID) ?></span>
            </div>
            <div class="paymentsListEven"><input type="radio" class="paymentPlan_value" name="payment"
                                                 value="6"><span><?php echo Course::getCoursePriceCredit(
                        StaticFilesHelper::createPath('image', 'course', 'percent.png'),
                        StaticFilesHelper::createPath('image', 'course', 'checkPercent.png'),
                        Course::getCreditCoursePrice($model->course_ID, 3), 3, $model->course_ID) ?></span>
            </div>
            <div class="paymentsListOdd"><input type="radio" class="paymentPlan_value" name="payment"
                                                value="7"><span><?php echo Course::getCoursePriceCredit(
                        StaticFilesHelper::createPath('image', 'course', 'percent.png'),
                        StaticFilesHelper::createPath('image', 'course', 'checkPercent.png'),
                        Course::getCreditCoursePrice($model->course_ID, 4), 4, $model->course_ID) ?></span>
            </div>
            <div class="paymentsListEven"><input type="radio" class="paymentPlan_value" name="payment"
                                                 value="8"><span><?php echo Course::getCoursePriceCredit(
                        StaticFilesHelper::createPath('image', 'course', 'percent.png'),
                        StaticFilesHelper::createPath('image', 'course', 'checkPercent.png'),
                        Course::getCreditCoursePrice($model->course_ID, 5), 5, $model->course_ID) ?></span>
            </div>
        </div>
        <?php }
        }?>
            <div class="markAndButton">
                <div class="markCourse">
                    <span class="colorP"><?php echo Yii::t('course', '0203'); ?> </span>
                            <span>
                                <?php echo CommonHelper::getRating($model->rating); ?>
                            </span>
                </div>
                <div class="startCourse">
                    <?php
                    if(Yii::app()->user->isGuest) {
                        echo CHtml::button(Yii::t('course', '0328'), array('id' => "paymentButton",
                            'onclick' => 'openSignIn();'));
                    } else{
                        if($model->status != 0) {
                            ?>
                            <a id="paymentButton" onclick="redirectToProfile()"
                               href="<?php echo Yii::app()->createUrl('studentreg/profile', array(
                                   'idUser' => Yii::app()->user->getId(),
                                   'course' => $model->course_ID,
                               ));?>"><?php echo Yii::t('course', '0328');?></a>
                        <?php
                        }
                    }?>
                </div>
            </div>
        </div>
    <?php if($model->status != 0) {
        $this->endWidget();
    } ?>
</div>


<script>
    $(function() {
        $('input:radio[name="payment"]').filter('[value="1"]').attr('checked', true);
    });
    function redirectToProfile(){
        schema = $('input:radio[name="payment"]:checked').val();
        $.cookie('courseSchema', schema, {'path': "/"});
        $.cookie('openProfileTab', 5, {'path': "/"});
    }
</script>