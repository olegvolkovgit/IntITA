<?php
?>
<div id="sidebarLesson">
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
                for ($i = 0; $i < $lecture->order; $i++) {
                    $lectureId = Lecture::getLectureIdByModuleOrder($lecture->idModule, $i + 1)->id;
                    ?>
                    <a href="<?php echo Yii::app()->createUrl("lesson/index", array("id" => $lectureId, "idCourse" => $idCourse)) ?>"><img
                            src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco1.png'); ?>"
                            title="<?php echo LectureHelper::getLectureTitle($lectureId); ?>"></a>
                <?php }
                for ($i = $lecture->order; $i < LectureHelper::getLessonsCount($lecture->idModule); $i++) {
                    $lectureId = Lecture::getLectureIdByModuleOrder($lecture->idModule, $i + 1)->id;
                    ?>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco0.png'); ?>"
                         title="<?php echo LectureHelper::getLectureTitle($lectureId); ?>">
                <?php } ?>
                <div id="iconImage">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'medalIcoFalse.png'); ?>">
                </div>
            </div>
        </ul>
    </div>
    <br>

    <div style="clear: both">
        <p><a href="skype:<?php echo '#' ?>?chat"><img
                    src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'skype.png'); ?>"></a></p>

        <p>
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
        </p>
    </div>
    <span id="discussionHeader"><?php echo Yii::t('lecture', '0617'); ?></span>

    <div id="discussion"></div>
</div>
<!--navigation vertical-->