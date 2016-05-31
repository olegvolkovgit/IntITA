<?php
/* @var $model Course
 * @var $price integer
 * @var $educForm string
 * @var $schema AdvancePaymentSchema
 */
?>
<span>
    <?php
    if ($price == 0) { ?>
        <span style="display: inline-block;margin-top: 3px" class="colorGreen">
            <?php echo Yii::t('module', '0421'); ?>
        </span>
    <?php } else { ?>
        <table class="mainPay">
            <tr>
                <td class="icoPay">
                    <img class="icoNoCheck"
                         src="<?php echo StaticFilesHelper::createPath('image', 'course', 'calendar.png'); ?>">
                    <img class="icoCheck"
                         src="<?php echo StaticFilesHelper::createPath('image', 'course', 'checkCalendar.png'); ?>">
                </td>
                <td>
                    <table>
                        <tr>
                            <td>
                                <div><?php echo Yii::t('course', '0200'); ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="numbers">
                                    <span><?php
                                        //todo
                                        echo round($schema->getSumma($model)/12) . ' ' . Yii::t('courses', '0322') . '/' .
                                            Yii::t('module', '0218') . ' х 12 ' . Yii::t('course', '0323') . ' = '; ?>
                                        <b>
                                            <?php echo round(($educForm == 'online')?$schema->getSumma($model):
                                            $schema->getSummaOffline($model)). ' ' .
                                                Yii::t('courses', '0322') ?>
                                        </b>
                                    </span>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    <?php }
    ?>
</span>