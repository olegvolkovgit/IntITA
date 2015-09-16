<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 16.09.2015
 * Time: 1:55
 */
?>
<div class="block">
    <ul>
        <li>
            <div class="line2">
                <img src="<?php echo $data->line2Image; ?>">
            </div>
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
        </li>
    </ul>
</div>