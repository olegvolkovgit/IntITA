<?php
?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/SidebarLesson.js"></script>
<div id="sidebarLesson">
    <div class="titlesBlock" id="titlesBlock">
        <ul>
            <li>
                <?php echo Yii::t('lecture','0070'); ?>
                <span><?php echo $lecture->getCourseInfoById()['courseTitle'];?></span>(<?php echo Yii::t('lecture','0071').strtoupper($lecture->getCourseInfoById()['courseLang']); ?>)
            </li>
            <li>
                <?php echo Yii::t('lecture','0072'); ?>
                <span><?php echo $lecture->getModuleInfoById()['moduleTitle']; ?></span>
            </li>
            <li><?php echo Yii::t('lecture','0073')." ".$lecture->order.': ';?>
                <span><?php echo $lecture->title; ?></span>
            </li>
            <li><?php echo Yii::t('lecture','0074'); ?>
                <div id="lectionTypeText"><?php echo $lecture->getTypeInfo()['text']; ?></div>
                <div id="lectionTypeImage"><img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', $lecture-> getTypeInfo()['image']); ?>"></div>
            </li>
            <br>
            <li><div id="subTitle"><?php echo Yii::t('lecture','0075'); ?></div>
                <div id="lectureTimeText"><?php echo $lecture->durationInMinutes.Yii::t('lecture','0076'); ?></div>
                <div id="lectureTimeImage">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'timeIco.png'); ?>">
                </div>
            </li>
            </br>
            <li>
                <?php echo '('.$lecture->order.' з '.$lecture->getModuleInfoById()['countLessons'].' занять)'; ?>
            </li>
            <div id="counter">
                <?php
                for ($i=0; $i<$lecture->order;$i++){ ?>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco1.png');?>">
                <?php }
                for ($i=0; $i<$lecture->getModuleInfoById()['countLessons']-$lecture->order;$i++){ ?>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'ratIco0.png');?>">
                <?php } ?>
                <div id="iconImage">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'medalIcoFalse.png');?>">
                </div>
            </div>
        </ul>
    </div>
    <p><a href="skype:<?php echo $lecture->getTeacherInfoById()['skype']; ?>?chat"><input type="submit" value="Skype"></a></p>
    <p><!-- mibew button --><a id="mibew-agent-button" href="http://intita.itatests.com/mibew/chat?locale=en&amp;style=default" target="_blank" onclick="Mibew.Objects.ChatPopups['55266d9dbb0cc4a'].open();return false;"><img src="http://intita.itatests.com/mibew/b?i=mblue&amp;lang=en" border="0" alt="" /></a><script type="text/javascript" src="http://intita.itatests.com/mibew/js/compiled/chat_popup.js"></script><script type="text/javascript">Mibew.ChatPopup.init({"id":"55266d9dbb0cc4a","url":"http:\/\/intita.itatests.com\/mibew\/chat?locale=en&style=default","preferIFrame":true,"modSecurity":false,"height":480,"width":640,"resizable":true,"styleLoader":"http:\/\/intita.itatests.com\/mibew\/chat\/style\/popup\/default"});</script><!-- / mibew button --></a></p>
</div>
<!--navigation vertical-->