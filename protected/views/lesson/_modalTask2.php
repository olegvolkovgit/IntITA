<!-- regform -->
<link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'modalTask2.css'); ?>"/>
<!-- regform end -->
<div class="mooda2">

    <div class="signIn22">
        <div id="heedd2">
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
            <div class="happily2">
                <p><?php echo Yii::t('lecture', '0683'); ?></p>
            </div>
            <input id="signInButtonM22" type="submit" value="<?php echo Yii::t('lecture', '0680'); ?>"
                   onclick="$('#mydialog3').dialog('close');return false;">
        </div>
    </div>
    <!-- form -->
</div>