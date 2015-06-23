<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 13.05.2015
 * Time: 16:22
 */
$stepHeader =  $mainpageModel->getHeader2();
$stepSubheader =  $mainpageModel->getSubheader2();
$stepSize = $mainpage['stepSize'];

?>

<div class="steps" >
    <div class="stepHeaderCont" style="width:<?php echo $stepSize; ?>">
        <div class="stepHeader">
            <h1><?php echo $stepHeader; ?></h1>
            <h3><?php echo $stepSubheader; ?></h3>
        </div>
    </div>
    <?php
    foreach ($stepsArray as $stepValue)
    {
        if ($stepValue->stepNumber % 2 <> 0)
        {
            ?>
            <div class="stepLeft" 	style="width:<?php echo $stepSize; ?>" >
                <div class="stepUrl">
                    <img class="grid" src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'grid.png'); ?>">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', $stepValue->stepImage); ?>">
                </div>
                <div class="line">
                </div>

                <img class="hexagon" src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'hexagon.png'); ?>">
                <div class="stepArticle">
                    <p class="stepNumber"><?php echo $stepValue->stepNumber; ?></p>
                    <p class="stepName"><?php echo Yii::t('step','0043'); ?></p>
                </div>
                <div class="stepInfo" style="min-height:<?php echo $stepSize*0.23 . 'px';?> ">
                    <h2><?php echo $stepValue->stepTitle; ?></h2>
                    <p><?php echo $stepValue->stepText; ?></p>
                </div>
            </div>
        <?php
        }
        else
        {
            ?>
            <div class="stepRight" style="width:<?php echo $stepSize; ?>" >
                <div class="stepUrl">
                    <img class="grid" src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'grid.png'); ?>">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', $stepValue->stepImage); ?>">
                </div>
                <div class="line">
                </div>
                <img class="hexagon" src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'hexagon.png'); ?>">
                <div class="stepArticle">
                    <p class="stepNumber"><?php echo $stepValue->stepNumber; ?></p>
                    <p class="stepName"><?php echo Yii::t('step','0043'); ?></p>
                </div>
                <div class="stepInfo">
                    <h2><?php echo $stepValue->stepTitle; ?></h2>
                    <p><?php echo $stepValue->stepText; ?></p>
                </div>
            </div>
        <?php
        }
    }
    ?>
</div>