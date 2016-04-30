<?php
/* @var $course Course */
$enabledLessonOrder = Lecture::getLastEnabledLessonOrder($lecture->idModule);
$lecturesCount = $lecture->module->lecturesCount();
?>
<div id="sidebarLesson">
    <div class="titlesBlock" id="titlesBlock">
        <ul><?php if ($idCourse != 0) {
                $course = Course::model()->findByPk($idCourse); ?>
                <li>
                    <?php echo Yii::t('lecture', '0070'); ?>
                    <a href="<?php echo Yii::app()->createUrl('course/index', array('id' => $idCourse)) ?>">
                        <?php echo $course->getTitle(); ?>
                    </a>(<?php echo Yii::t('lecture', '0071') . strtoupper($course->language); ?>
                    )
                </li>
                <li>
                    <?php echo Yii::t('lecture', '0072'); ?>
                    <a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => $lecture['idModule'], 'idCourse' => $idCourse)) ?>"><?php echo $lecture->module->getTitle(); ?></a>
                </li>
            <?php } else { ?>
                <li>
                    <?php echo Yii::t('lecture', '0072'); ?>
                    <a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => $lecture['idModule'])) ?>"><?php echo $lecture->module->getTitle(); ?></a>
                </li>
            <?php } ?>
            <li ng-if=lecturesData.currentOrder ><?php echo Yii::t('lecture', '0073') ?> {{lecturesData.currentOrder}}:
                <?php
                $this->renderPartial('_jsChaptersListTemplate', array('idLecture' => $lecture->id, 'isFree' => $lecture->isFree, 'passedPages' => $passedPages, 'editMode' => $editMode, 'idCourse' => $idCourse));
                ?>
            </li>
            <li style="margin-bottom: 0"><?php echo Yii::t('lecture', '0074'); ?>
                <div id="lectionTypeText"><?php
                    $titleParam = 'title_'.CommonHelper::getLanguage();
                    echo $lecture->type->$titleParam; ?></div>
                <div id="lectionTypeImage"><img
                        src="<?php echo StaticFilesHelper::createPath('image', 'lecture', $lecture->type->image); ?>">
                </div>
            </li>
            <li>
                <div id="subTitle"><?php echo Yii::t('lecture', '0075'); ?></div>
                <div id="lectureTimeText"><?php echo $lecture->durationInMinutes . Yii::t('lecture', '0076'); ?></div>
                <div id="lectureTimeImage">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'timeIco.png'); ?>">
                </div>
            </li>
            <li ng-if=lecturesData.currentOrder style="margin-bottom:0;margin-top: 20px">
                ({{lecturesData.currentOrder}} / {{lecturesData.lectures.length}} <?php echo Yii::t('lecture', '0616'); ?>)
            </li>
            <div id="counter">
                <span ng-repeat="lecture in lecturesData.lectures track by $index">
                    <a ng-if=lecture.access
                       ng-attr-href="{{ lecture.order!='<?php echo $lecture->order; ?>' && lecture.link || undefined }}"
                       tooltip-html-unsafe="{{lecture.title}}">
                        <div class="lectureAccess" ng-class="{thisLecture: lecture.order=='<?php echo $lecture->order; ?>'}"></div>
                    </a>
                    <a ng-if=!lecture.access
                       tooltip-html-unsafe="<span class='titleNoAccessMin'>{{lecture.title}}</span><span class='noAccessMin'> (Заняття недоступне)</span>">
                        <div class="lectureDisabled"></div>
                    </a>
                </span>
                <div ng-if=lecturesData.currentOrder id="iconImage">
                    <img ng-src="{{moduleFinished}}">
                </div>
            </div>
        </ul>
    </div>
    <br>

    <div class="helpHeader"><?php echo Yii::t('lecture', '0660'); ?></div>
    <div style="clear: both;margin-left: 15px;">
        <div style="display: inline-block; margin-right: 10px;">
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
                    "url": "http:\/\/<?php echo Config::getBaseUrlWithoutSchema(); ?>\/mibew\/chat?locale=<?php echo CommonHelper::getLanguage(); ?>&style=default<?php echo StudentReg::getNameEmail(); ?>",
                    "preferIFrame": true,
                    "modSecurity": false,
                    "width": 640,
                    "height": 480,
                    "resizable": true,
                    "styleLoader": "http:\/\/<?php echo Config::getBaseUrlWithoutSchema(); ?>\/mibew\/chat\/style\/popup"
                });
            </script>
            <!-- / mibew button -->
        </div>
        <div style="display: inline-block">
            <a class='consultationButtons' href="skype:<?php echo '#' ?>?chat">
                <div class="skypeAssistance">
                    <img class="consultationLogos"
                         src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'skypeLogo.png'); ?>">

                    <div class="consultationText"><?php echo Yii::t('lecture', '0665'); ?></div>
                </div>
            </a>
        </div>
    </div>

    <div id="discussionHeader"><?php echo Yii::t('lecture', '0617'); ?></div>

    <div id="discussion"></div>
        <div style="display: inline-block;margin-left: 15px">
            <a class='consultationButtons'
               href="<?php echo Yii::app()->createUrl('/consultationscalendar/index', array('lectureId' => $lecture->id, 'idCourse' => $idCourse)); ?>">
                <div id="consultationAssistance">
                    <img class="consultationLogos"
                         src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'consultationLogo.png'); ?>">

                    <div class="consultationText"><?php echo Yii::t('lecture', '0079') ?></div>
                </div>
            </a>
        </div>
</div>
<!--navigation vertical-->
<script>
    $("#send-message").click(function (e) {
        var mibewMessage = $('[name="message"]');
        mibewMessage.val($.trim(mibewMessage.val()));
    });
</script>