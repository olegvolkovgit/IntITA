
<div class="mailPassword">
    <form action="/profile/activateMail" method="post" novalidate name="mailPassword">
    <div class="rowpass">
        <span class="passEye">
            <input id="password" class="signInPassM" placeholder=<?=Yii::t('regexp', '0171')?> size="60" maxlength="20" required="required" ng-model="pw1" name="password" type="password">
        </span>
    </div>

    <div class="rowpass">
        <span class="passEye">
            <input id="passwordRepeat" class="signInPassM" placeholder="Повтор пароля" size="60" maxlength="20" required="required" ng-model="pw2" pw-check="pw1" name="passwordRepeat" type="password">
        </span>
        <div><span class="clientValidationError" ng-show="mailPassword.$invalid && mailPassword.$dirty && mailPassword.$error.pwmatch"><?=Yii::t('error', '0269')?><span></div>
    </div>

    <input id="signInButtonM" ng-disabled="mailPassword.$invalid" value="<?=Yii::t('regexp', '0267')?>" disabled="disabled" type="submit">
    </form>
</div>
