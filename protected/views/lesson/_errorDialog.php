<div class="modalError">
    <div class="modalBody">
            <table>
                <tr>
                    <td>
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'errorLess.jpg'); ?>">
                    </td>
                    <td>
                        <h1><?php echo Yii::t('lecture', '0682'); ?></h1>
                    </td>
                </tr>
            </table>
            <div class="modalContent">
                <p><?php echo Yii::t('lecture', '0683'); ?></p>
            </div>
            <input class="modalButton" type="submit" value="<?php echo Yii::t('lecture', '0680'); ?>"
                   ng-click="errorDialogHide()" >
    </div>
</div>