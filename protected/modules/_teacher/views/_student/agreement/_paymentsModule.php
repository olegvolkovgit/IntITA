<?php
/**
 * @var $model Module
 * @var $course int
 * @var $offerScenario string
 * @var $price integer
 * @var $scenario string
 * @var $educForm integer
 */
?>
<div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-body" style="margin-left: 30px; margin-top: 20px">
            <div id="rowRadio">
                <table class="mainPay">
                    <tr>
                        <td class="icoPay">
                            <img class="icoCheck"
                                 src="<?= StaticFilesHelper::createPath('image', 'course', 'checkWallet.png'); ?>">
                        </td>
                        <td>
                    <tr>
                        <td>
                            <div><?= Yii::t('payment', '0661'); ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="coursePriceStatus2">
                                <?php if ($price == 0) { ?>
                                    <span style="display: inline-block;margin-top: 3px" class="colorGreen">
                                        <?= Yii::t('module', '0421'); ?>
                                    </span>
                                <?php } else {
                                    echo $price . " " . Yii::t('courses', '0322'); ?>
                                <?php } ?>
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<br>
<button class="btn btn-primary" type="button"
        ng-click="createAccount(
            '<?php echo Yii::app()->createUrl('/_teacher/_student/student/newModuleAgreement'); ?>',
            '0',
            '<?php echo $model->module_ID; ?>',
            'Module',
            '<?= $offerScenario ?>',
            '',
            '<?= $educForm ?>',
            '')"><?php echo Yii::t('profile', '0261'); ?>
</button>