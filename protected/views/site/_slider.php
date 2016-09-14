<?php
/* @var $slider Carousel*/
?>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'sliderMainpage.js'); ?>"></script>
<div ng-cloak id="sliderBlock">
    <div id="sliderCenterBox">
        <div class="sliderCenterBoxText">
            <p><?php echo Yii::t('slider', '0005'); ?></p>
        </div>
        <div class="sliderCenterBoxLine">
            <hr>
        </div>
        <div class="sliderSnake">
            <div class="snake">
                <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'line.png'); ?>">
                <?php if (Yii::app()->user->isGuest) {
                    ?>
                    <div class="button">
                        <a class="sliderButton" href="#form"><?php echo Yii::t('slider', '0008'); ?></a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div id="slider" class="owl-carousel">
        <?php
        foreach ($slider as $key) {
                ?>
                <div class="slide">
                    <div>
                        <p><?php echo Yii::t('slider', $key->getText()); ?></p>
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', $key->pictureURL); ?>"/>
                    </div>
                </div>
            <?php }
        ?>
    </div>
    <div class="mouseLine">
        <a id="mouseLine" <?php echo StudentReg::linkInMouseLine(); ?>>
            <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'mouseLine.png'); ?>"/>
        </a>
    </div>
</div>
<div id="sliderMini">
    <p class="sliderMiniTitle"><?php echo Yii::t('slider', '0005'); ?></p>
    <div class="sliderMiniTitleLine">
        <hr>
    </div>
    <p class="sliderMiniText"><?php echo Yii::t('slider', $slider[0]->getText()); ?></p>
    <?php if (Yii::app()->user->isGuest) {
        ?>
        <div class="button">
            <a class="sliderButton" href="#form"><?php echo Yii::t('slider', '0008'); ?></a>
        </div>
        <?php
    }
    ?>
</div>