<?php
?><!--navigation vertical-->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/SidebarLesson.js"></script>
<div id="sidebarLesson">
    <div class="titlesBlock" id="titlesBlock">
        <ul>
            <li>
                <?php echo Yii::t('lecture','0070'); ?>
                <span>Програмування для чайників</span>(<?php echo Yii::t('lecture','0071'); ?>UA)
            </li>
            <li>
                <?php echo Yii::t('lecture','0072'); ?>
                <span>Мова програмування PHP<?php //echo $lecture->lectureModule; ?></span>
            </li>
            <li><?php echo Yii::t('lecture','0073').$lecture->findByPk(1)->order.': ';?>
                <span><?php echo $lecture->findByPk(1)->title; ?></span>
            </li>
            <li><?php echo Yii::t('lecture','0074'); ?>
                <div id="lectionTypeText">лекція<?php //echo //$lecture->lectureTypeText; ?></div>
                <div id="lectionTypeImage"><img src="<?php echo Yii::app()->request->baseUrl.'/css/images/lectureType.png'; ?>"></div>
            </li>
            <li><div id="subTitle"><?php echo Yii::t('lecture','0075'); ?></div>
                <div id="lectureTimeText">40<?php echo Yii::t('lecture','0076'); ?></div>
                <div id="lectureTimeImage">
                    <img src="<?php echo Yii::app()->request->baseUrl.$lecture->findByPk(1)->lectureTimeImage; ?>">
                </div>
            </li>
            </br>
            <li>
                <?php echo '('.$lecture->findByPk(1)->order.' з '.'6'.' занять)'; ?>
                <div id="iconImage">
                    <img src="<?php echo Yii::app()->request->baseUrl.$lecture->findByPk(1)->iconIsDone;?>">
                </div>
            </li>
            <div id="counter">
                <?php
                for ($i=0; $i<$lecture->order;$i++){ ?>
                    <img src="<?php echo Yii::app()->request->baseUrl.$lecture->findByPk(1)->lectureOverlookedImage;?>">
                <?php }
                for ($i=0; $i<6-$lecture->order;$i++){ ?>
                    <img src="<?php echo Yii::app()->request->baseUrl.$lecture->findByPk(1)->lectureUnwatchedImage;?>">
                <?php } ?>
            </div>
        </ul>
    </div>
    <p><a href="skype:<?php echo $skype; ?>?chat"><input type="submit" value="Skype"></a></p>
    <p><!-- mibew button --><a id="mibew-agent-button" href="http://intita.itatests.com/mibew/chat?locale=en&amp;style=default" target="_blank" onclick="Mibew.Objects.ChatPopups['55266d9dbb0cc4a'].open();return false;"><img src="http://intita.itatests.com/mibew/b?i=mblue&amp;lang=en" border="0" alt="" /></a><script type="text/javascript" src="http://intita.itatests.com/mibew/js/compiled/chat_popup.js"></script><script type="text/javascript">Mibew.ChatPopup.init({"id":"55266d9dbb0cc4a","url":"http:\/\/intita.itatests.com\/mibew\/chat?locale=en&style=default","preferIFrame":true,"modSecurity":false,"height":480,"width":640,"resizable":true,"styleLoader":"http:\/\/intita.itatests.com\/mibew\/chat\/style\/popup\/default"});</script><!-- / mibew button --></a></p>
</div>
<!--navigation vertical-->