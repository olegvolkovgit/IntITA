<?php
$enabledLessonOrder = LectureHelper::getLastEnabledLessonOrder($lecture->idModule);
?>
<div id="sidebarLesson" ng-controller="sidebarCtrl">
    <div class="titlesBlock" id="titlesBlock">
        <ul><?php if ($idCourse != 0) { ?>
                <li>
                    <?php echo Yii::t('lecture', '0070'); ?>
                    <a href="<?php echo Yii::app()->createUrl('course/index', array('id' => $idCourse)) ?>"><?php echo $lecture->getCourseInfoById($idCourse)['courseTitle']; ?></a>(<?php echo Yii::t('lecture', '0071') . strtoupper($lecture->getCourseInfoById($idCourse)['courseLang']); ?>
                    )
                </li>
                <li>
                    <?php echo Yii::t('lecture', '0072'); ?>
                    <a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => $lecture['idModule'], 'idCourse' => $idCourse)) ?>"><?php echo ModuleHelper::getModuleName($lecture->idModule); ?></a>
                </li>
            <?php } else { ?>
                <li>
                    <?php echo Yii::t('lecture', '0072'); ?>
                    <a href="<?php echo Yii::app()->createUrl('module/index', array('idModule' => $lecture['idModule'])) ?>"><?php echo ModuleHelper::getModuleName($lecture->idModule); ?></a>
                </li>
            <?php } ?>
            <li><?php echo Yii::t('lecture', '0073') . " " . $lecture->order . ': '; ?>
                <span><?php echo LectureHelper::getLectureTitle($lecture->id); ?></span>
<!--                <span>--><?php //$this->renderPartial('_chaptersList', array('idLecture' => $lecture->id,'isFree' => $lecture->isFree, 'passedPages' => $passedPages, 'editMode' =>$editMode, 'idCourse' => $idCourse)); ?><!--</span>-->
            </li>
            <li><?php echo Yii::t('lecture', '0074'); ?>
                <div id="lectionTypeText"><?php echo $lecture->getTypeInfo()['text']; ?></div>
                <div id="lectionTypeImage"><img
                        src="<?php echo StaticFilesHelper::createPath('image', 'lecture', $lecture->getTypeInfo()['image']); ?>">
                </div>
            </li>
            <li>
                <div id="subTitle"><?php echo Yii::t('lecture', '0075'); ?></div>
                <div id="lectureTimeText"><?php echo $lecture->durationInMinutes . Yii::t('lecture', '0076'); ?></div>
                <div id="lectureTimeImage">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'timeIco.png'); ?>">
                </div>
            </li>
            <li>
                <?php echo '(' . $lecture->order . ' / ' . LectureHelper::getLessonsCount($lecture->idModule) . ' ' . Yii::t('lecture', '0616') . ')'; ?>
            </li>
            <div id="counter">
                <?php
                if ($editMode || AccessHelper::isAdmin()) {
                    for ($i = 0; $i < LectureHelper::getLessonsCount($lecture->idModule); $i++) {
                        $lectureId = Lecture::getLectureIdByModuleOrder($lecture->idModule, $i + 1)->id;
                        ?>
                        <a href="<?php echo Yii::app()->createUrl("lesson/index", array("id" => $lectureId, "idCourse" => $idCourse)) ?>"
                           popover-trigger="mouseenter"
                           uib-popover="<?php echo LectureHelper::getLectureTitle($lectureId); ?>">
                            <div class="lectureAccess"></div>
                        </a>
                    <?php }
                } else {
                    for ($i = 0; $i < LectureHelper::getLessonsCount($lecture->idModule); $i++) {
                        $lectureId = Lecture::getLectureIdByModuleOrder($lecture->idModule, $i + 1)->id;
                        $lectureOrder = Lecture::getLectureIdByModuleOrder($lecture->idModule, $i + 1)->order;
                        if (AccessHelper::accesLecture($lectureId, $lectureOrder, $enabledLessonOrder)) { ?>
                            <a href="<?php echo Yii::app()->createUrl("lesson/index", array("id" => $lectureId, "idCourse" => $idCourse)) ?>"
                               popover-trigger="mouseenter"
                               uib-popover="<?php echo LectureHelper::getLectureTitle($lectureId); ?>">
                                <div class="lectureAccess"></div>
                            </a>
                        <?php } else { ?>
                            <a popover-trigger="mouseenter"
                               uib-popover="<?php echo LectureHelper::getLectureTitle($lectureId); ?>">
                                <div class="lectureDisabled"></div>
                            </a>
                        <?php }
                    } ?>
                    <div id="iconImage">
                        <img
                            src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'medalIcoFalse.png'); ?>">
                    </div>
                <?php } ?>
            </div>
            <?php if (AccessHelper::canAddConsultation()) {?>
                <div class="calendar">
                    <?php echo CHtml::link(Yii::t('lecture', '0079'), Yii::app()->createUrl('/consultationscalendar/index', array('lectureId' => $lecture->id, 'idCourse' => $idCourse))); ?>
                </div>
            <?php } ?>
        </ul>
    </div>
    <br>

    <div style="clear: both">
        <div style="display: inline-block; margin-right: 10px;">
            <!-- mibew button -->
            <a id="mibew-agent-button"
               href="<?php echo MibewHelper::getMibewHost(); ?>/mibew/chat?locale=<?php echo MibewHelper::getLg(); ?>;style=default"
               target="_blank" onclick="Mibew.Objects.ChatPopups['55bf44d367c197db'].open();return false;">
                <img
                    src="<?php echo MibewHelper::getMibewHost(); ?>/mibew/b?i=mblue&amp;lang=<?php echo MibewHelper::getLg(); ?>"
                    border="0" alt=""/>
            </a>
            <script type="text/javascript"
                    src="<?php echo MibewHelper::getMibewHost(); ?>/mibew/js/compiled/chat_popup.js"></script>
            <script type="text/javascript">Mibew.ChatPopup.init({
                    "id": "55bf44d367c197db",
                    "url": "http:\/\/<?php echo MibewHelper::getMibewHostWithoutHeader(); ?>\/mibew\/chat?locale=<?php echo MibewHelper::getLg(); ?>&style=default<?php echo MibewHelper::getNameEmail(); ?>",
                    "preferIFrame": true,
                    "modSecurity": false,
                    "width": 640,
                    "height": 480,
                    "resizable": true,
                    "styleLoader": "http:\/\/<?php echo MibewHelper::getMibewHostWithoutHeader(); ?>\/mibew\/chat\/style\/popup"
                });
            </script>
            <!-- / mibew button -->
        </div>
        <div style="display: inline-block">
            <a href="skype:<?php echo '#' ?>?chat"><img
                    src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'skype.png'); ?>"></a>
        </div>
    </div>
    <span id="discussionHeader"><?php echo Yii::t('lecture', '0617'); ?></span>

    <div id="discussion"></div>
</div>
<!--navigation vertical-->