<?php
/* @var $model Course */
/* @var $discount integer */
/* @var $price integer */
?>
<span>
<?php
if ($price == 0) {
    ?>
    <span style="display: inline-block;margin-top: 3px" class="colorGreen">
        <?php echo Yii::t('module', '0421'); ?>
    </span>
<?php
}
if ($discount == 0) {
    ?>
    <table class="mainPay">
        <tr>
            <td class="icoPay">
                <img class="icoNoCheck"
                     src="<?php echo StaticFilesHelper::createPath('image', 'course', 'wallet.png'); ?>">
                <img class="icoCheck"
                     src="<?php echo StaticFilesHelper::createPath('image', 'course', 'checkWallet.png'); ?>">
            </td>
            <td>
                <table>
                    <tr>
                        <td>
                            <div><?php echo Yii::t('course', '0197'); ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                    <span class="coursePriceStatus2">
                        <?php echo $price . " " . Yii::t('courses', '0322'); ?>
                    </span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
<?php
}
?>
    <table class="mainPay">
        <tr>
            <td class="icoPay">
                <img class="icoNoCheck"
                     src="<?php echo StaticFilesHelper::createPath('image', 'course', 'wallet.png'); ?>">
                <img class="icoCheck"
                     src="<?php echo StaticFilesHelper::createPath('image', 'course', 'checkWallet.png'); ?>">
            </td>
            <td>
                <table>
                    <tr>
                        <td>
                            <div><?php echo Yii::t('course', '0197'); ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="numbers">
                                <span
                                    class="coursePriceStatus1"><?php echo $price . " " . Yii::t('courses', '0322') ?></span>
                                &nbsp<span class="coursePriceStatus2">
                                <?php echo PaymentHelper::discountedPrice($price, $discount) . " " . Yii::t('courses', '0322'); ?>
                            </span>
                                <br>
                            <span id="discount">
                                <img style="text-align:right" src="
                                <?php echo StaticFilesHelper::createPath('image', 'course', 'pig.png') ?>"/>
                                (<?php echo Yii::t('courses', '0144') . ' - ' . $discount . '%)'; ?>
                                </span>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</span>