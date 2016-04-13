<?php $i = 1; ?>
<div class="aboutusslider">
    <div id="slider" class="owl-carousel">
        <?php foreach ($slider as $key) {
            ?>
            <div class="slideAbout">
                <div class="abouttext">
                    <div class="about<?php echo $key->order ?> aboutUsText" style="
                        top: <?php echo $key->top ?>%;
                        color:<?php echo $key->text_color ?>" left="<?php echo $key->left ?>">
                        <div class="headerAbout">
                            <?php echo Yii::t("slider", "0549") ?>
                        </div>
                        <div class="sliderCenterBoxLine">
                            <hr style="border-color:<?php echo $key->text_color ?>">
                        </div>
                        <div class="textabout">
                            <?php echo Yii::t("slider", $key->getText()) ?>
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
<script>
    $(function() { textSliderCentr('<?php echo count($slider) ?>'); });
    $(window).resize(function() { textSliderCentr('<?php echo count($slider) ?>'); });
</script>