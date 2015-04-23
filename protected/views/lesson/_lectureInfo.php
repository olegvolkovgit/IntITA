<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 09.04.2015
 * Time: 15:27
 */

?>
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/lessonsStyle.css" />


<div class="lectureImageMain">
        <img src="<?php echo Yii::app()->request->baseUrl.$lecture->image; ?>">
</div>

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
<li><?php echo Yii::t('lecture','0073').$lecture->order.': ';?>
    <span><?php echo $lecture->title; ?></span>
</li>
<li><?php echo Yii::t('lecture','0074'); ?>
    <div id="lectionTypeText">лекція<?php //echo $lecture->lectureTypeText; ?></div>
    <div id="lectionTypeImage"><img src="<?php echo Yii::app()->request->baseUrl.'/css/images/lectureType.png'; ?>"></div>
</li>
<li><div id="subTitle"><?php echo Yii::t('lecture','0075'); ?></div>
    <div id="lectureTimeText">40<?php echo Yii::t('lecture','0076'); ?></div>
    <div id="lectureTimeImage"><img src="<?php echo Yii::app()->request->baseUrl.$lecture->lectureTimeImage; ?>"></div>
</li>
</br>
<li>
    <?php echo '('.$lecture->order.' з '.'6'.' занять)'; ?>
    <div id="iconImage">
        <img src="<?php echo Yii::app()->request->baseUrl.'/css/images/medalIcoFalse.png';?>">
    </div>
</li>
<div id="counter">
    <?php
    for ($i=0; $i<$lecture->findByPk(1)->order;$i++){ ?>
        <img src="<?php echo Yii::app()->request->baseUrl.$lecture->lectureOverlookedImage;?>">
    <?php }
    for ($i=0; $i<6-$lecture->findByPk(1)->order;$i++){ ?>
        <img src="<?php echo Yii::app()->request->baseUrl.$lecture->lectureUnwatchedImage;?>">
    <?php } ?>
</div>
</ul>

</div>