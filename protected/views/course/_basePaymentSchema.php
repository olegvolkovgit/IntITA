<?php
/* @var $model Course */
/* @var $discount integer */
/* @var $price integer */
/* @var $number integer */
/* @var $image1 string */
/* @var $image2 string */
?>

<span>
    <?php
    if ($price == 0) {
        ?>
        <span style="display: inline-block;margin-top: 3px" class="colorGreen">
            <?php Yii::t('module', '0421'); ?>
        </span>
    <?php
    }
    if ($discount == 0) { ?>
        <table class="mainPay">
            <tr>
                <td class="icoPay">
                    <img class="icoNoCheck" src="<?php echo $image1; ?>">
                    <img class="icoCheck" src="<?php echo $image2; ?>">
                </td>
                <td>
                    <table>
                        <tr>
                            <td>
                                <div style="color:#4b75a4">
                                    <?php echo $number . ' ' . Yii::t('course', '0198'); ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="numbers">
                                <span class="coursePriceStatus"><?php echo $price . " " . Yii::t('courses', '0322'); ?>
                                </span>= <?php echo round($price / $number) . ' ' . Yii::t('courses', '0322'); ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    <?php
    } else {
        ?>
        <table class="mainPay">
            <tr>
                <td class="icoPay">
                    <img class="icoNoCheck" src="<?php echo $image1; ?>">
                    <img class="icoCheck" src="<?php echo $image2; ?>">
                </td>
                <td>
                    <table>
                        <tr>
                            <td>
                                <div style="color:#4b75a4">
                                    <?php echo $number . ' ' . Yii::t('course', '0198'); ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="numbers">
                                <span class="coursePriceStatus">
                                    <?php echo $price . " " . Yii::t('courses', '0322'); ?>
                                </span>&nbsp
                                <span class="coursePriceStatus2">
                                    <?php echo PaymentHelper::discountedPrice($price, $discount) . " " .
                                        Yii::t('courses', '0322'); ?>=</span>
                                <span><?php echo round(PaymentHelper::discountedPrice($price, $discount) / $number) . ' ' .
                                        Yii::t('courses', '0322') . ' x ' . $number . ' ' . Yii::t('course', '0323'); ?>
                                </span>
                                </div>
                            <span id="discount">
                                <img style="text-align:right"
                                     src="<?php echo StaticFilesHelper::createPath('image', 'course', 'pig.png'); ?>">
                                (<?php echo Yii::t('courses', '0144') . ' - ' . $discount . '%)'; ?>
                            </span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    <?php } ?>
</span>