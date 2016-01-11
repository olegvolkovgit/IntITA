<?php
/* @var $model Course */
$price = $model->getBasePrice();
?>
<div class="paymentsForm">
    <?php
    if ($model->status != 0) {
        $form = $this->beginWidget('CActiveForm', array(
            'action' => '#',
            'id' => 'payments-form',
            'enableAjaxValidation' => false,
        )); ?>
        <?php
        if ($price == 0) {
            echo Yii::t('courses', '0147') . ' '; ?>
            <span class="colorGreen"><?= Yii::t('module', '0421'); ?></span>
            <?php
        } else {
            ?>
            <input value="1" type="hidden" name="schema"/>
            <span class="spoilerLinks"
                  onclick="paymentSpoiler('<?php echo Yii::t('course', '0414'); ?>', '<?php echo Yii::t('course', '0415'); ?>')">
        <span id="spoilerClick"><?php echo Yii::t('course', '0414'); ?></span>
        <span id="spoilerTriangle"> &#9660;</span></span>

            <div id="rowRadio">
                <div class="paymentsListOdd">
                    <input id='firstRadio' type="radio" class="paymentPlan_value" name="payment" value="1">
                    <?php $this->renderPartial('_advancePaymentSchema', array(
                        'model' => $model,
                        'price' => $price,
                        'discount' => 30
                    )); ?>
                </div>

                <div class="spoilerBody">
                    <div class="paymentsListEven">
                        <input type="radio" class="paymentPlan_value" name="payment" value="2">
                        <?php $this->renderPartial('_basePaymentSchema', array(
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
                        <?php $this->renderPartial('_basePaymentSchema', array(
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
                        <?php $this->renderPartial('_monthlyPaymentSchema', array('model' => $model, 'price' => $price)); ?>
                    </div>

                    <div class="paymentsListOdd">
                        <input type="radio" class="paymentPlan_value" name="payment" value="5">
                        <?php $this->renderPartial('_creditPaymentSchema', array('model' => $model, 'price' => $price,
                            'year' => 2)); ?>
                    </div>

                    <div class="paymentsListEven">
                        <input type="radio" class="paymentPlan_value" name="payment" value="6">
                        <?php $this->renderPartial('_creditPaymentSchema', array('model' => $model, 'price' => $price,
                            'year' => 3)); ?>
                    </div>

                    <div class="paymentsListOdd">
                        <input type="radio" class="paymentPlan_value" name="payment" value="7">
                        <?php $this->renderPartial('_creditPaymentSchema', array('model' => $model, 'price' => $price,
                            'year' => 4)); ?>
                    </div>

                    <div class="paymentsListEven">
                        <input type="radio" class="paymentPlan_value" name="payment" value="8">
                        <?php $this->renderPartial('_creditPaymentSchema', array('model' => $model, 'price' => $price,
                            'year' => 5)); ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="markAndButton">
            <div class="markCourse">
                <span class="colorP"><?php echo Yii::t('course', '0203'); ?> </span>
                            <span>
                                <?php echo CommonHelper::getRating($model->rating); ?>
                            </span>
            </div>
            <div class="startCourse">
                <?php
                if (Yii::app()->user->isGuest) {
                    echo CHtml::button(Yii::t('course', '0328'), array('id' => "paymentButton",
                        'onclick' => 'openSignIn();'));
                } else {
                    if ($model->status != 0) {
                        ?>
                        <a id="paymentButton" onclick="redirectToProfile()"
                           href="<?php echo Yii::app()->createUrl('studentreg/profile', array(
                               'idUser' => Yii::app()->user->getId(),
                               'course' => $model->course_ID,
                           )); ?>"><?php echo Yii::t('course', '0328'); ?></a>
                        <?php
                    }
                } ?>
            </div>
        </div>

        <?php if ($model->status != 0) {
            $this->endWidget();
        } ?>
    <?php } ?>
</div>


<script>
    $(function () {
        $('input:radio[name="payment"]').filter('[value="1"]').attr('checked', true);
    });
    function redirectToProfile() {
        schema = $('input:radio[name="payment"]:checked').val();
        $.cookie('courseSchema', schema, {'path': "/"});
        $.cookie('openProfileTab', 5, {'path': "/"});
    }
</script>
