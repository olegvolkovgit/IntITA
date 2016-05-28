<?php
/**
 * @var $module integer
 * @var $course integer
 * @var $schemaNum integer
 * @var $educationForm
 * @var $type string
 */
?>
<div class="col col-md-9">
    <?php
    $param = (isset(Yii::app()->session['lg']))?"offer_".Yii::app()->session['lg'].".html":"offer_ua.html";
    echo file_get_contents(Config::getBaseUrl().'/files/offers/'.$param);
    ?>
    <br>
    <form>
        <div class="checkbox">
            <label><input type="checkbox" value="agree" id="agree" onclick="enableAgreeButton();">
                Я погоджусь з умовами публічної оферти та даю згоду на обробку моїх персональних даних
            </label>
        </div>
        <input name="module" type="hidden" value="<?php echo $module; ?>">
        <input name="schemaNum" type="hidden" value="<?php echo $schemaNum; ?>">
        <input name="course" type="hidden" value="<?php echo $course; ?>">
        <input name="user" type="hidden" value="<?php echo Yii::app()->user->getId(); ?>">
        <input name="educationForm" type="hidden" value="<?= $educationForm ?>">
        <br>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" disabled id="agreeButton"
                    onclick="newAgreement(
                        '<?=Yii::app()->createUrl("/_teacher/_student/student/newAgreement");?>',
                        '<?=$type?>',
                        '<?=$course?>',
                        '<?=$module?>',
                        '<?=$schemaNum?>',
                        '<?=$educationForm?>'
                        ); return false;">
                Підписати договір
            </button>
            <button type="reset" class="btn btn-default" onclick="back(); return false;">Назад</button>
        </div>
    </form>
</div>