<div class="helpButtons">
    <div class="helpHeader"><?php echo Yii::t('lecture', '0660'); ?></div>
    <div class="chat">
        <!-- mibew button -->
        <a id="mibew-agent-button"
           href="<?php echo Config::getBaseUrl(); ?>/mibew/chat?locale=<?php echo CommonHelper::getLanguage(); ?>;style=default"
           target="_blank" onclick="Mibew.Objects.ChatPopups['55bf44d367c197db'].open();return false;">
            <div style="display: inline-block">
                <div class="skypeAssistance">
                    <img class="consultationLogos"
                         src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'mibewLogo.png'); ?>">
                    <div class="mibewText"><?php echo Yii::t('mibew', '0807') ?></div>
                </div>
            </div>
        </a>
        <script type="text/javascript"
                src="<?php echo Config::getBaseUrl(); ?>/mibew/js/compiled/chat_popup.js"></script>
        <script type="text/javascript">Mibew.ChatPopup.init({
                "id": "55bf44d367c197db",
                "url": "https:\/\/<?php echo Config::getBaseUrlWithoutSchema(); ?>\/mibew\/chat?locale=<?php echo CommonHelper::getLanguage(); ?>&style=default<?php echo StudentReg::getNameEmail(); ?>",
                "preferIFrame": true,
                "modSecurity": false,
                "width": 640,
                "height": 480,
                "resizable": true,
                "styleLoader": "https:\/\/<?php echo Config::getBaseUrlWithoutSchema(); ?>\/mibew\/chat\/style\/popup"
            });
        </script>
        <!-- / mibew button -->
    </div>
    <div class="skype">
        <a class='consultationButtons' href="skype:<?php echo '#' ?>?chat">
            <div class="skypeAssistance">
                <img class="consultationLogos"
                     src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'skypeLogo.png'); ?>">

                <div class="consultationText"><?php echo Yii::t('lecture', '0665'); ?></div>
            </div>
        </a>
    </div>
</div>

<div class="forum">
    <div id="discussionHeader" ><?php echo Yii::t('lecture', '0617'); ?></div>
    <div id="discussion"></div>
</div>

<?php if(PayModules::model()->checkModulePermission(Yii::app()->user->id, $lecture['idModule'], array('read')) && $lecture->type->id!=1){ ?>
    <div class="consultations">
        <a class='consultationButtons'
           href="<?php echo Yii::app()->createUrl('/consultationscalendar/index', array('lectureId' => $lecture->id, 'idCourse' => $idCourse)); ?>">
            <div id="consultationAssistance">
                <img class="consultationLogos"
                     src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'consultationLogo.png'); ?>">

                <div class="consultationText"><?php echo Yii::t('lecture', '0079') ?></div>
            </div>
        </a>
    </div>
<?php } ?>
<!--navigation vertical-->
<script>
    $("#send-message").click(function (e) {
        var mibewMessage = $('[name="message"]');
        mibewMessage.val($.trim(mibewMessage.val()));
    });
</script>