<?php $i = 1; ?>
<div class="aboutusslider">
    <div id="slider" class="owl-carousel">
        <?php foreach ($slider as $key) {
            ?>
            <div class="slideAbout">
                <div class="abouttext">
                    <div class="about<?php echo $key->image_order ?>">
                        <div class="headerAbout">
                            <?php echo Yii::t("slider", "0549") ?>
                        </div>
                        <div class="sliderCenterBoxLine">
                            <hr>
                        </div>
                        <div class="textabout">
                            <?php echo Yii::t("slider", $key->text) ?>
                        </div>
                    </div>
                </div>
                <img src="<?php echo StaticFilesHelper::createPath('image', 'aboutus', $key->pictureUrl); ?>"/>
            </div>
            <?php $i++;
        } ?>
    </div>
</div>

<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'slider.css'); ?>"/>
<link type="text/css" rel="stylesheet"
      href="<?php echo StaticFilesHelper::fullPathTo('js', 'plugins/owl-carousel/owl.theme.css'); ?>"/>
<link type="text/css" rel="stylesheet"
      href="<?php echo StaticFilesHelper::fullPathTo('js', 'plugins/owl-carousel/owl.carousel.css') ?>"/>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'plugins/owl-carousel/owl.carousel.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'slider.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'sliderAboutUs.js'); ?>"></script>