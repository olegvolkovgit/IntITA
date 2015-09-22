<?php
?>
<div id="sidebarLesson">
    <div class="titlesBlock" id="titlesBlock">
        <ul>
            <li>
                <?php echo Yii::t('lecture', '0070'); ?>
                <span><?php echo $lecture->getCourseInfoById($idCourse)['courseTitle']; ?></span>(<?php echo Yii::t('lecture', '0071') . strtoupper($lecture->getCourseInfoById($idCourse)['courseLang']); ?>
                )
            </li>
            <li>
                <?php echo Yii::t('lecture', '0072'); ?>
                <span><?php echo $lecture->getModuleInfoById($idCourse)['moduleTitle']; ?></span>
            </li>
            <li><?php echo Yii::t('lecture', '0073') . " " . $lecture->order . ': '; ?>
                <span><?php echo LectureHelper::getLectureTitle($lecture->id); ?></span>
            </li>
            <li><?php echo Yii::t('lecture', '0074'); ?>
                <div id="lectionTypeText"><?php echo $lecture->getTypeInfo()['text']; ?></div>
                <div id="lectionTypeImage"><img
                        src="<?php echo StaticFilesHelper::createPath('image', 'lecture', $lecture->getTypeInfo()['image']); ?>">
                </div>
            </li>
            <br>
            <li>
                <div id="subTitle"><?php echo Yii::t('lecture', '0075'); ?></div>
                <div id="lectureTimeText"><?php echo $lecture->durationInMinutes . Yii::t('lecture', '0076'); ?></div>
                <div id="lectureTimeImage">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'timeIco.png'); ?>">
                </div>
            </li>
            <br>
            <li>
                <?php echo '(' . $lecture->order . ' з ' . $lecture->getModuleInfoById($idCourse)['countLessons'] . ' занять)'; ?>
            </li>
            <div id="counter">
                <?php
                for ($i = 0; $i < $lecture->order; $i++) { ?>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco1.png');?>">
                <?php }
                for ($i = 0; $i < $lecture->getModuleInfoById($idCourse)['countLessons'] - $lecture->order; $i++) { ?>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco0.png');?>">
                <?php } ?>
                <div id="iconImage">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'medalIcoFalse.png'); ?>">
                </div>
            </div>
        </ul>
    </div>
    <br>
    <div style="clear: both">
        <p><a href="skype:<?php echo '#' ?>?chat"><input type="submit" value="Skype"></a></p>

        <p>
            <!-- mibew button -->
            <a id="mibew-agent-button" href="<?php echo MibewHelper::getMibewHost(); ?>/mibew/chat?locale=<?php echo MibewHelper::getLg(); ?>;style=default" target="_blank" onclick="Mibew.Objects.ChatPopups['55bf44d367c197db'].open();return false;">
                <img src="<?php echo MibewHelper::getMibewHost(); ?>/mibew/b?i=mblue&amp;lang=<?php echo MibewHelper::getLg(); ?>" border="0" alt="" />
            </a>
            <script type="text/javascript" src="<?php echo MibewHelper::getMibewHost(); ?>/mibew/js/compiled/chat_popup.js"></script>
            <script type="text/javascript">Mibew.ChatPopup.init({
                    "id":"55bf44d367c197db","url":"http:\/\/<?php echo MibewHelper::getMibewHostWithoutHeader(); ?>\/mibew\/chat?locale=<?php echo MibewHelper::getLg(); ?>&style=default<?php echo MibewHelper::getNameEmail(); ?>",
                    "preferIFrame":true,
                    "modSecurity":false,
                    "width":640,"height":480,"resizable":true,
                    "styleLoader":"http:\/\/<?php echo MibewHelper::getMibewHostWithoutHeader(); ?>\/mibew\/chat\/style\/popup"});
            </script>
            <!-- / mibew button -->
        </p>

    </div>
    <span>Форум</span>
    <div id="discussion"></div>
</div>
<!--navigation vertical-->