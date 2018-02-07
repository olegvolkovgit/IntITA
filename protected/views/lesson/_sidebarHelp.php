<div class="forum">
    <div id="discussionHeader" ><?php echo Yii::t('lecture', '0617'); ?></div>
    <div id="discussion"></div>
</div>

<?php //if(1){ ?>
<?php if($lecture->module->checkPaidAccess(Yii::app()->user->getId())){ ?>
    <div class="consultations">
        <!--<a class='consultationButtons'
           href="<?php /*echo Yii::app()->createUrl('/consultationscalendar/index', array('lectureId' => $lecture->id, 'idCourse' => $idCourse)); */?>">
            <div id="consultationAssistance">
                <img class="consultationLogos"
                     src="<?php /*echo StaticFilesHelper::createPath('image', 'lecture', 'consultationLogo.png'); */?>">

                <div class="consultationText"><?php /*echo Yii::t('lecture', '0079') */?></div>
            </div>
        </a>-->
    </div>
<?php } ?>
<!--navigation vertical-->
<script>
    $("#send-message").click(function (e) {
        var mibewMessage = $('[name="message"]');
        mibewMessage.val($.trim(mibewMessage.val()));
    });
</script>