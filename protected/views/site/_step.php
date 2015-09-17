<?php
/* @var $data Step*/
if ($data->stepNumber % 2 <> 0)
{
    ?>
    <div class="stepLeft" 	style="width:958px" >
        <div class="stepUrl">
            <img class="grid" src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'grid.png'); ?>">
            <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', $data->stepImage); ?>">
        </div>
        <div class="line">
        </div>

        <img class="hexagon" src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'hexagon.png'); ?>">
        <div class="stepArticle">
            <p class="stepNumber"><?php echo $data->stepNumber; ?></p>
            <p class="stepName"><?php echo Yii::t('step','0043'); ?></p>
        </div>
        <div class="stepInfo" style="min-height:<?php echo 958*0.23 . 'px';?> ">
            <h2><?php echo  Yii::t('step', $data->stepTitle); ?></h2>
            <p><?php echo Yii::t('step', $data->stepText); ?></p>
        </div>
    </div>
<?php
}
else
{
    ?>
    <div class="stepRight" style="width:958px" >
        <div class="stepUrl">
            <img class="grid" src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'grid.png'); ?>">
            <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', $data->stepImage); ?>">
        </div>
        <div class="line">
        </div>
        <img class="hexagon" src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'hexagon.png'); ?>">
        <div class="stepArticle">
            <p class="stepNumber"><?php echo $data->stepNumber; ?></p>
            <p class="stepName"><?php echo Yii::t('step','0043'); ?></p>
        </div>
        <div class="stepInfo">
            <h2><?php echo  Yii::t('step', $data->stepTitle); ?></h2>
            <p><?php echo Yii::t('step', $data->stepText); ?></p>
        </div>
    </div>
<?php
}