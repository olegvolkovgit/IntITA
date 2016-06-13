<?php
/**
 * @var $model Course
 * @var $price integer
 * @var $schema LoanPaymentSchema
 * @var $educForm string
 */

$price = ($educForm == 'online')?$schema->getSumma($model):round(($schema->getSumma($model) * Config::getCoeffModuleOffline()));
$year = $schema->yearsCount();
?>
<span>
    <?php
    if ($price == 0) { ?>
        <span style="display: inline-block;margin-top: 3px" class="colorGreen"><?php echo Yii::t('module', '0421'); ?>
            </span>
    <?php
    } else { ?>
        <table class="mainPay">
            <tr>
                <td class="icoPay">
                    <img class="icoNoCheck"
                         src="<?php echo StaticFilesHelper::createPath('image', 'course', 'percent.png'); ?>">
                    <img class="icoCheck"
                         src="<?php echo StaticFilesHelper::createPath('image', 'course', 'checkPercent.png'); ?>">
                </td>
                <td>
                    <table>
                        <tr>
                            <td>
                                <div><?php echo Yii::t('course', '0425') . ' ' . $year . ' ' .
                                        CommonHelper::getYearsTermination($year); ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="numbers">
                                    <span><?php echo Yii::t('courses', '0322') . sprintf ("%01.2f", round($price/(12 * $year), 2)) . '/' .
                                            Yii::t('payments', '0865') . ' х ' . (12 * $year) . ' ' . Yii::t('course', '0324'); ?>
                                        <b> &asymp;
                                            <?php echo Yii::t('courses', '0322') . sprintf ("%01.2f", round($price, 2)); ?></b>
                                    </span>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    <?php } ?>
</span>