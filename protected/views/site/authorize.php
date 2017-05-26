<?php
/**
 * @var $callBack
*/
?>
<?php $url=(isset($callBack) && $callBack)?$callBack:StudentReg::authRedirect(true); ?>

<?php if(Yii::app()->controller->id == 'lesson' || !empty($url)){ ?>
<div id="lessonHumMenu">
    <?php $this->renderPartial('/lesson/_authorizeMenu'); ?>
</div>
<?php } ?>
<div ng-app class="authorizePage">
    <div>
        <?php echo 'Для перегляду сторінки спочатку авторизуйся' ?>
    </div>
    <?php echo $this->decodeWidgets('{{w:AuthorizationFormWidget|dialog=false;id=studentreg-form;callBack='.$url.'}}'); ?>
</div>