<?php
/* @var $data Step*/
if ($data->stepNumber % 2 <> 0)
{
    ?>
    <div class="stepLeft">
        <div class="stepUrl">
            <img class="grid" src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'grid.png'); ?>">
            <img class="stepImg" src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', $data->stepImage); ?>">
            <img class="hexagon" src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'hexagon.png'); ?>">
            <img class="hexagon800" src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'hexagon800.png'); ?>">
            <div class="stepArticle">
                <p class="stepNumber"><?php echo $data->stepNumber; ?></p>
                <p class="stepName"><?php echo Yii::t('step','0043'); ?></p>
            </div>
        </div>
        <div class="stepInfo" style="min-height:220px">
            <h2><?php echo  Yii::t('step', $data->stepTitle); ?></h2>
            <p><?php echo Yii::t('step', $data->stepText); ?></p>
        </div>
    </div>
<?php
}
else
{
    ?>
    <div class="stepRight">
        <div class="stepUrl">
            <img class="grid" src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'grid.png'); ?>">
            <img class="stepImg" src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', $data->stepImage); ?>">
            <img class="hexagon" src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'hexagon.png'); ?>">
            <img class="hexagon800" src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'hexagon800.png'); ?>">
            <div class="stepArticle">
                <p class="stepNumber"><?php echo $data->stepNumber; ?></p>
                <p class="stepName"><?php echo Yii::t('step','0043'); ?></p>
            </div>
        </div>
        <div class="stepInfo">
            <h2><?php echo  Yii::t('step', $data->stepTitle); ?></h2>
            <p><?php echo Yii::t('step', $data->stepText); ?></p>
        </div>
    </div>
<?php
}