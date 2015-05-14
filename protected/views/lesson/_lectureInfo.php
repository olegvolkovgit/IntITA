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
        <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', $lecture->image); ?>">
</div>

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
<li><?php echo Yii::t('lecture','0073').$lecture->order.': ';?>
    <span><?php echo $lecture->title; ?></span>
</li>
<li><?php echo Yii::t('lecture','0074'); ?>
    <div id="lectionTypeText"><?php echo $lecture-> getTypeInfo()['text']; ?></div>
    <div id="lectionTypeImage"><img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', $lecture-> getTypeInfo()['image']); ?>"></div>
</li>
<br>
<li><div id="subTitle"><?php echo Yii::t('lecture','0075'); ?></div>
    <div id="lectureTimeText"><?php echo $lecture->durationInMinutes.Yii::t('lecture','0076'); ?></div>
    <div id="lectureTimeImage"><img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'timeIco.png'); ?>"></div>
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