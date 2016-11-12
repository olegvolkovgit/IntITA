<?php
/* @var $data AboutUs
 */
?>
<div class="block">
    <div class="icon">
        <img src="<?php echo StaticFilesHelper::createImagePath('aboutus', $data->iconImage); ?>">
    </div>
    <div class="title">
        <?php echo Yii::t('aboutus', $data->titleText); ?>
        <p>
            <?php echo Yii::t('aboutus', $data->textAbout); ?>
        </p>
    </div>
    <a href="<?php echo Yii::app()->createUrl('aboutus/index', array('id' => $data->blockID)); ?>">
        <?php echo Yii::t('mainpage', '0004'); ?>
    </a>
</div>