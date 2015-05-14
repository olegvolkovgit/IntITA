<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 14.05.2015
 * Time: 18:49
 */
?>
<p class="text2"><big>Історія навчання</big></p>

<div class="lessonBlock" id="lessonBlock">
    <span class="spoilerLinks"><span class="spoilerClick">(показати)</span><span class="spoilerTriangle"> &#9660;</span></span>
    <div class="spoilerBody">
        <?php echo $this->renderPartial('_moduleHistory', array('moduleTitle' => 'Модуль 1'));?>
        <?php echo $this->renderPartial('_moduleHistory', array('moduleTitle' => 'Модуль 2'));?>
        <?php echo $this->renderPartial('_moduleHistory', array('moduleTitle' => 'Модуль 3'));?>
        <?php echo $this->renderPartial('_moduleHistory', array('moduleTitle' => 'Модуль 4'));?>
        <?php echo $this->renderPartial('_moduleHistory', array('moduleTitle' => 'Модуль 5'));?>
        <?php echo $this->renderPartial('_moduleHistory', array('moduleTitle' => 'Модуль 6'));?>
    </div>
    <div class="profileMyRatting1">
        <p>Рейтинг загальний:
            <?php
            for ($i = 0; $i < 9; $i++) {
                ?>
                <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starFull.png');?>">
            <?php
            }
            for ($i = 0; $i < 1; $i++) {
                ?>
                <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starEmpty.png');?>">
            <?php
            }
            ?></p>
    </div>
</div>