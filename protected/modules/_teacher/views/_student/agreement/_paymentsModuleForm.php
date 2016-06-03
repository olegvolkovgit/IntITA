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
            <?php $form = $this->beginWidget('CActiveForm', array(
                'action' => '#',
                'id' => 'payments-form',
                'enableAjaxValidation' => false,
            ));
            if ($price == 0) {
                echo Yii::t('courses', '0147'); ?>
                <span style="display: inline-block;margin-top: 3px" class="colorGreen">
                    <?= Yii::t('module', '0421'); ?>
                </span>
            <?php } else {
                ?>
                <div id="rowRadio">
                    <table class="mainPay">
                        <tr>
                            <td class="icoPay">
                                <img class="icoNoCheck"
                                     src="<?= StaticFilesHelper::createPath('image', 'course', 'wallet.png'); ?>">
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
                                    <?= $price . " " . Yii::t('courses', '0322'); ?>
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            <?php } ?>
            <input name="module" type="hidden" value="<?php echo $model->module_ID; ?>">
            <input name="user" type="hidden" value="<?php echo Yii::app()->user->getId(); ?>">
            <input name="educationForm" type="hidden" value="<?= $scenario ?>">
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>

<?php if ($price > 0) { ?>
    <br>
    <button class="btn btn-primary" type="button"
            onclick="createAccount('<?php echo Yii::app()->createUrl('/_teacher/_student/student/newModuleAgreement'); ?>',
                '<?= $course ?>', '<?php echo $model->module_ID; ?>', 'Module', '<?= $offerScenario ?>',
                '', '<?= $educForm ?>')"><?php echo Yii::t('profile', '0261'); ?></button>
<?php } ?>

<script>
    $jq(function () {
        $jq('input:radio[name="payment"]').filter('[value="1"]').attr('checked', true);
    });
</script>