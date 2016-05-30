<?php
/* @var $model Course */
/* @var $price integer */
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
                                    <span><?php echo Course::getSummaBySchemaNum($model->course_ID, 4) . ' ' . Yii::t('courses', '0322') . '/' .
                                            Yii::t('payments', '0865') . ' х 12 ' . Yii::t('course', '0323') . ' = '; ?>
                                        <b>
                                            <?php echo Course::getSummaBySchemaNum($model->course_ID, 4, true) . ' ' .
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