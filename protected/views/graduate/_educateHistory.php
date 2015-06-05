<div class="lessonBlock" id="lessonBlock">
    <span class="spoilerLinks"><span class="spoilerClick">Розгорнути історію навчання</span><span class="spoilerTriangle"> &#9660;</span></span>
    <div class="spoilerBody">
        <?php echo $this->renderPartial('_moduleHistory', array('moduleTitle' => 'Модуль 1'));?>
        <?php echo $this->renderPartial('_moduleHistory', array('moduleTitle' => 'Модуль 2'));?>
        <?php echo $this->renderPartial('_moduleHistory', array('moduleTitle' => 'Модуль 3'));?>
        <?php echo $this->renderPartial('_moduleHistory', array('moduleTitle' => 'Модуль 4'));?>
        <?php echo $this->renderPartial('_moduleHistory', array('moduleTitle' => 'Модуль 5'));?>
        <?php echo $this->renderPartial('_moduleHistory', array('moduleTitle' => 'Модуль 6'));?>
    </div>
    <div class="text" style="padding-top: 5px;">
        <?php echo Yii::t('graduates', '0319')?>
        <?php
        for ($i = 0; $i < $data['rate']; $i++) {
            ?>
            <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starFull.png');?>">
        <?php
        }
        for ($i = 0; $i < 10-$data['rate']; $i++) {
            ?>
            <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'starEmpty.png');?>">
        <?php
        }
        ?>
    </div>
</div>