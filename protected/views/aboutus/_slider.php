<div class="aboutusslider">
    <div id="slider" class="owl-carousel">
        <?php
        foreach($slider as $key){?>
            <div class="slide">
                <div>
                    <p><?php echo Yii::t('slider', $key->text); ?></p>
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'aboutus', $key->pictureUrl); ?>" />
                </div>
            </div>
        <?php }
        ?>
    </div>
</div>

<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'slider.css'); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('js', 'plugins/owl-carousel/owl.theme.css'); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('js', 'plugins/owl-carousel/owl.carousel.css') ?>"/>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'plugins/owl-carousel/owl.carousel.js'); ?>"></script>
<script src="<?php echo Config::getBaseUrl(); ?>/scripts/slider.js"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'sliderAboutUs.js'); ?>"></script>